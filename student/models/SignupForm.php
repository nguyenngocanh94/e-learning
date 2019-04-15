<?php
namespace student\models;

use common\models\Student;
use common\utilities\Hash;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $name;
    public $phone;
    public $class;
    public $dob;
    public $address;
    public $imagePath;
    /**
     * @var UploadedFile
     */
    public $image;
    public $contact;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['image', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
            ['name', 'required'],
            ['phone', 'required'],
            ['class', 'required'],
            ['dob', 'required'],
            ['address', 'required'],
            ['contact', 'safe'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        $this->image = UploadedFile::getInstance($this,'image');
        $this->imagePath = Yii::getAlias("@uploads") .'/'. Hash::hash($this->image->baseName) . '.' . $this->image->extension;
        $this->image->saveAs($this->imagePath, false);
        if ($this->validate()) {
            $user = new Student();
            $user->username = $this->username;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->address = $this->address;
            $user->dob = $this->dob;
            $user->class = $this->class;
            $user->contact = $this->contact;
            $user->phone = $this->phone;
            $user->image = $this->imagePath;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            return $user->save() && $this->sendEmail($user);
        }

        return null;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
