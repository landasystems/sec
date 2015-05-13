<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormController
 *
 * @author user2
 */
class FormController extends CController {
    
    public $breadcrumbs;  
    public $layout = 'mainSingle';
    
public function actionDelete($id)
	{
		
    
//                if(Yii::app()->request->isPostRequest)
//		{
			// we only allow deletion via POST request
             $model = FormBuilder::model()->findByPk($id);
//             landa()->selfAccess($model->created_user_id);
    
            $model->delete();
                     
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//                            
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
      
    
    public function actionIndex()
	{
            $param = json_decode($_GET['menuParam']);
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new FormBuilder('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['FormBuilder']))
		{
                        $model->attributes=$_GET['FormBuilder'];
			
			
                   	
                       if (!empty($model->id)) $criteria->addCondition('id = "'.$model->id.'"');
                     
                    	
                       if (!empty($model->form_category_id)) $criteria->addCondition('form_category_id = "'.$model->form_category_id.'"');
                     
                    	
                       if (!empty($model->builder_result)) $criteria->addCondition('builder_result = "'.$model->builder_result.'"');
                     
                    	
                       if (!empty($model->created)) $criteria->addCondition('created = "'.$model->created.'"');
                     
                    	
                       if (!empty($model->modified)) $criteria->addCondition('modified = "'.$model->modified.'"');
                     
                    	
//                       if (!empty($model->created_user_id)) $criteria->addCondition('created_user_id = "'.$model->created_user_id.'"');
                     
                    			
		}
                 $session['FormBuilder_records']=FormBuilder::model()->findAll($criteria); 
       

                $this->render('index',array(
			'model'=>$model,
                        'param'=>$param,
		));

	}
    
    
    
    public function actionCreate(){
        if(isset($_POST['form_category_id']))
        {
            $model=new FormBuilder;
            $model->form_category_id=$_POST['form_category_id'];
            $model->builder_result=json_encode($_POST);
            if($model->save())
            $this->redirect(array('index','id'=>$_POST['form_category_id']));
        }
     
        $param = json_decode($_GET['menuParam']);     
        $this->render('create',array(                
                'param'=>$param,
        ));
        
    }
    public function actionUpdate(){

        
        if(isset($_POST['id']))
        {                                 
            $model=FormBuilder::model()->findByPk($_POST['id']);            
//            landa()->selfAccess($model->created_user_id);            
//            $model->form_category_id=$_POST['form_category_id'];
            $model->builder_result=json_encode($_POST);
            if($model->save())
            $this->redirect(array('index','id'=>$_POST['form_category_id']));
        }
        
        $param = json_decode($_GET['menuParam']);     
        $this->render('update',array(                
                'param'=>$param,
        ));
        
    }
    
}
