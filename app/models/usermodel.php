<?php
namespace PHPMVC\Models;
use PHPMVC\Models\UserGroupPrivilegeModel;
class UserModel extends AbstractModel
{
    public $UserId;
    public $Username;
    public $password;
    public $email;
    public $phoneNumber;
    public $subscriptionDate;
    public $lastlogin;
    public $GroupId;
    public $Status;
/**
 * @var  UserProfilesModel

 */
    public $profile;
    public $privileges;

    protected  static  $tableName = 'app_users';


    protected  static  $tableSchema =array(
        'UserId'               =>self::DATA_TYPE_INT,
        'Username'             => self::DATA_TYPE_STR,
        'password'             => self::DATA_TYPE_STR,
        'email'                =>self::DATA_TYPE_STR,
        'phoneNumber'          =>self::DATA_TYPE_STR,
        'subscriptionDate'     => self::DATA_TYPE_STR,
        'lastlogin'            =>self::DATA_TYPE_STR,
        'GroupId'              =>self::DATA_TYPE_INT,
        'Status'              =>self::DATA_TYPE_INT

    ) ;

    protected  static  $primaryKey = 'UserId';

    public  function cryptPassword($password){
      //  $salt = ' $2a$07$y10ko9FV5v1uinmiORKzcx$';
          $this->password = crypt($password,APP_SALT);
    }

    // TODO:: FIX THE TABLE ALIASING
	public static function getUsers(UserModel $user)
    {
        return self::get(
           'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.groupid = au.GroupId WHERE au.UserId !='.$user->UserId
        );
    }
    public static function userExists($username){
       return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE Username = "'.$username . '"
            ');

    }

    public static function authenticate($username , $password ,$session){
      //crypt($password,APP_SALT);
       /* $salt = ' $2a$07$y10ko9FV5v1uinmiORKzcx$';
       crypt($password,$salt); */
        $sql = 'SELECT *,(SELECT GroupName FROM app_users_groups WHERE app_users_groups.groupid = '. self::$tableName .' . groupid) GroupName FROM ' . self::$tableName . ' WHERE Username = "'. $username  .'" AND password = "' . $password .'"';
        $foubdUser = self::getOne($sql);
  if (false !== $foubdUser){
      if ($foubdUser->status == 2){
        return 2;
      }
            $foubdUser->lastlogin = date('Y-m-d H:i:s');
            $foubdUser->save();
            $foubdUser->profile = UserProfilesModel::getByPK($foubdUser->UserId);
            $foubdUser->privileges =  UserGroupPrivilegeModel::getPrivilegesForGroup( $foubdUser->GroupId);
            $session->u = $foubdUser;
      
            return 1;
        }
        return false;
    }

}