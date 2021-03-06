<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    /**
     *
     * @var User current logging in user
     */
    public $current_user;

    /**
     * If user logged in then get all recent activities detail and add to stream array
     * @param string $action     
     * @author Pham Tri Thai
     */   
    public function beforeAction($action)
    {
        if (!Yii::app()->user->isGuest) {

            if (!isset(Yii::app()->session['current_user'])) {
                // broken state
                Yii::app()->session['current_user'] = User::model()->findByAttributes(array('username' => Yii::app()->user->id));
            }
            $this->current_user =  Yii::app()->session['current_user'];
        }
        return parent::beforeAction($action);
    }
}