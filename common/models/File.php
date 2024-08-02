<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $name
 * @property string $full_path
 * @property int|null $last_pars_row
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ParsData[] $parsDatas
 */
class File extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
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
            [['name', 'full_path'], 'required'],
            [['last_pars_row', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'full_path' => 'Full Path',
            'last_pars_row' => 'Last Pars Row',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ParsDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParsDatas()
    {
        return $this->hasMany(ParsData::class, ['file_id' => 'id']);
    }
}
