<?php

class BbiiTopicController extends Controller
{
        public $breadcrumbs;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters() {
            return array(
                'accessControl', // perform access control for CRUD operations
            );
        }

        public function accessRules() {
            return array(
                array('allow', // c
                    'actions' => array('index', 'create'),
                    'expression' => 'app()->controller->isValidAccess(1,"c")'
                ),
                array('allow', // r
                    'actions' => array('index', 'view'),
                    'expression' => 'app()->controller->isValidAccess(1,"r")'
                ),
                array('allow', // u
                    'actions' => array('index', 'update'),
                    'expression' => 'app()->controller->isValidAccess(1,"u")'
                ),
                array('allow', // d
                    'actions' => array('index', 'delete'),
                    'expression' => 'app()->controller->isValidAccess(1,"d")'
                )
            );
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                cs()->registerScript('read', '
                    $("form input, form textarea, form select").each(function(){
                    $(this).prop("disabled", true);
                });');
		$_GET['v'] = true;
                $this->actionUpdate($id);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BbiiTopic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BbiiTopic']))
		{
			$model->attributes=$_POST['BbiiTopic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BbiiTopic']))
		{
			$model->attributes=$_POST['BbiiTopic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{        

                $model=new BbiiTopic('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['BbiiTopic']))
		{
                        $model->attributes=$_GET['BbiiTopic'];
			
                   	
                       if (!empty($model->id)) $criteria->addCondition('id = "'.$model->id.'"');
                     
                    	
                       if (!empty($model->forum_id)) $criteria->addCondition('forum_id = "'.$model->forum_id.'"');
                     
                    	
                       if (!empty($model->user_id)) $criteria->addCondition('user_id = "'.$model->user_id.'"');
                     
                    	
                       if (!empty($model->title)) $criteria->addCondition('title = "'.$model->title.'"');
                     
                    	
                       if (!empty($model->first_post_id)) $criteria->addCondition('first_post_id = "'.$model->first_post_id.'"');
                     
                    	
                       if (!empty($model->last_post_id)) $criteria->addCondition('last_post_id = "'.$model->last_post_id.'"');
                     
                    	
                       if (!empty($model->num_replies)) $criteria->addCondition('num_replies = "'.$model->num_replies.'"');
                     
                    	
                       if (!empty($model->num_views)) $criteria->addCondition('num_views = "'.$model->num_views.'"');
                     
                    	
                       if (!empty($model->approved)) $criteria->addCondition('approved = "'.$model->approved.'"');
                     
                    	
                       if (!empty($model->locked)) $criteria->addCondition('locked = "'.$model->locked.'"');
                     
                    	
                       if (!empty($model->sticky)) $criteria->addCondition('sticky = "'.$model->sticky.'"');
                     
                    	
                       if (!empty($model->global)) $criteria->addCondition('global = "'.$model->global.'"');
                     
                    	
                       if (!empty($model->moved)) $criteria->addCondition('moved = "'.$model->moved.'"');
                     
                    	
                       if (!empty($model->upvoted)) $criteria->addCondition('upvoted = "'.$model->upvoted.'"');
                     
                    	
		}       

                $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=BbiiTopic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bbii-topic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
