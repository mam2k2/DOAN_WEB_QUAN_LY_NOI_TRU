<?php

namespace api\models;

use common\models\Branch;
/**
 * This is the model class for table "admin_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $avatar
 * @property int $branch_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Branch $branch
 */

class AdminUser extends \common\models\AdminUser
{
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'avatar',
            'roleName' => function(){
                return $this->role->name ?? "Hệ thống";
            },
            'branch' => function(){
                return [
                    'id' => $this->branch->id ?? null,
                    'name' => $this->branch->name ?? null,
                    'address' => $this->branch->address ?? null,
                ];
            },
            'status' => function(){
                return self::getStatuses()[$this->status] ?? null;
            },
        ];
    }
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
}