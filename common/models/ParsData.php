<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "pars_data".
 *
 * @property int $id
 * @property int $file_id
 * @property string|null $client_ip
 * @property string|null $time_local
 * @property string|null $request
 * @property string|null $status
 * @property string|null $body_bytes_sent
 * @property string|null $http_referer
 * @property string|null $http_user_agent
 * @property string|null $full_row
 * @property int $created_at
 * @property int $updated_at
 *
 * @property File $file
 */
class ParsData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pars_data';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id',], 'required'],
            [['file_id', 'created_at', 'updated_at'], 'integer'],
            [['full_row'], 'string'],
            [['client_ip', 'time_local', 'request', 'status', 'body_bytes_sent', 'http_referer', 'http_user_agent'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'client_ip' => 'Client Ip',
            'time_local' => 'Time Local',
            'request' => 'Request',
            'status' => 'Status',
            'body_bytes_sent' => 'Body Bytes Sent',
            'http_referer' => 'Http Referer',
            'http_user_agent' => 'Http User Agent',
            'full_row' => 'Full Row',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }
}
