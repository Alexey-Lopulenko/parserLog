<?php

namespace console\controllers;


use common\models\ParsData;
use common\models\File;
use yii\console\Controller;
use yii\helpers\BaseConsole;

class ParsController extends Controller
{
    public function actionIndex()
    {
        echo "Hello, this is a controller for pars nginx log file.\n";
        echo "run -> php yii pars/pars-log 'path to file' for get log data.\n";
        return 0;
    }

    public function actionParsLog($logFile = null)
    {
        if ($logFile) {
            $fileName = pathinfo($logFile, PATHINFO_FILENAME);

            $lastRow = 0;

            $file = File::find()
                ->where(['name' => $fileName])
                ->andWhere(['full_path' => $logFile])
                ->one();

            if ($file) {
                $startOfYesterday = strtotime('yesterday midnight');
                $endOfYesterday = strtotime('today midnight') - 1;

                if ($file->updated_at >= $startOfYesterday && $file->updated_at <= $endOfYesterday) {
                    echo "The timestamp is from yesterday.\n";
                    $file->last_pars_row = 0;
                    $file->save();
                }

                $lastRow = $file->last_pars_row;
            } else {
                $file = new File();
                $file->name = $fileName;
                $file->full_path = $logFile;

                if (!$file->save()) {
                    $this->stdout("Failed save data file {$fileName}\n", BaseConsole::FG_RED);
                }
            }


            if (file_exists($logFile)) {
                $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $k => $line) {

                    if ($k + 1 <= $lastRow) {
                        continue;
                    }
                    if (preg_match('/(?P<remote_addr>\S+) \S+ \S+ \[(?P<time_local>.*?)\] "(?P<request>.*?)" (?P<status>\d+) (?P<body_bytes_sent>\d+) "(?P<http_referer>.*?)" "(?P<http_user_agent>.*?)"/', $line, $matches)) {
                        $logEntry = [
                            'remote_addr' => $matches['remote_addr'],
                            'time_local' => $matches['time_local'],
                            'request' => $matches['request'],
                            'status' => $matches['status'],
                            'body_bytes_sent' => $matches['body_bytes_sent'],
                            'http_referer' => $matches['http_referer'],
                            'http_user_agent' => $matches['http_user_agent'],
                        ];

                        $parsData = new ParsData();
                        $parsData->file_id = $file->id;
                        $parsData->client_ip = $logEntry['remote_addr'];
                        $parsData->time_local = $logEntry['time_local'];
                        $parsData->request = $logEntry['request'];
                        $parsData->status = $logEntry['status'];
                        $parsData->body_bytes_sent = $logEntry['body_bytes_sent'];
                        $parsData->http_referer = $logEntry['http_referer'];
                        $parsData->http_user_agent = $logEntry['http_user_agent'];
                        $parsData->full_row = $line;

                        if ($parsData->save()) {
                            $file->last_pars_row = $k + 1;
                            $file->save();
                            $this->stdout("Save data!\n", BaseConsole::FG_GREY);
                        } else {
                            print_r($parsData->errors);
                            die;
                        }


                        $this->stdout($k + 1 . "\n", BaseConsole::FG_RED);
                        $this->stdout($line . "\n", BaseConsole::FG_RED);

                        print_r($logEntry);
                    }
                }
            } else {
                $this->stdout("Log file not found.\n", BaseConsole::FG_RED);

            }
        } else {
            $this->stdout("Set path to log file!\n", BaseConsole::FG_RED);
        }

        return 0;
    }
}