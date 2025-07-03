<?php

namespace App\Services;

use App\Dao\UserDao;
use App\Bo\UserBo;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class UserService
{
    protected $dao;
    protected $bo;

    public function __construct(UserDao $dao, UserBo $bo)
    {
        $this->dao = $dao;
        $this->bo = $bo;
    }

    public function getAllUsers()
    {
        return Cache::remember('users.all', 60, function () {
            return $this->dao->all();
        });
    }

    public function getUser($id)
    {
        return Cache::remember("users.{$id}", 60, function () use ($id) {
            return $this->dao->find($id);
        });
    }

    public function createUser(array $data)
    {
        $processed = $this->bo->processData($data);
        $user = $this->dao->create($processed);
        Cache::forget('users.all');
        return $user;
    }

    public function updateUser(User $user, array $data)
    {
        $processed = $this->bo->processData($data);
        $this->dao->update($user, $processed);
        Cache::forget("users.{$user->id}");
        Cache::forget('users.all');
        return $user->fresh();
    }
}
