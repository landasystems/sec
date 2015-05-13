<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UrlRule
 *
 * @author landa
 */
class LandaUrlRule extends CBaseUrlRule {

    //public $connectionID = 'db';
//    public function createUrl($manager, $route, $params, $ampersand) {
//        
//    }
    public function createUrl($manager, $route, $params, $ampersand) {

        if (array_key_exists('page', $params) /* && some other condition */) {
            $matches = explode('/', substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - 5)); //remove .html
            
            if (!isset($params['alias']))
                $params['alias'] = "";
            
            $numAlias = array_search($params['alias'], $matches);
            $numPage = array_search('page', $matches);

            //check url uri, any or not, if any just replace the parameter of page
            if ($numPage) {
                $matches[$numPage + 1] = $params['page'];
                $start = $numAlias + 1;
            } else {
                $uri[] = $params['alias'];
                $uri[] = 'page';
                $uri[] = $params['page'];
                $start = $numAlias + 2;
            }

            for ($i = $start; $i <= count($matches); $i++) {
                $uri[] = $matches[$i - 1];
            }
            return implode('/', $uri) . '.html';

//            return $params['alias'] . '/page/' . $params['page'] . '.html';
//            }
        } elseif (isset($params['alias'])) {
            $matches = explode('/', substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - 5)); //remove .html
            $numAlias = array_search($params['alias'], $matches);
            $numPage = array_search('page', $matches);

            $uri[] = $params['alias'];
            //check url uri, any or not, if any just replace the parameter of start
            if ($numPage) {
                $start = $numAlias + 4;
            } else {
                trace($numAlias . '-----');
                $start = $numAlias + 2;
            }

            for ($i = $start; $i <= count($matches); $i++) {
                $uri[] = $matches[$i - 1];
            }
            return implode('/', $uri) . '.html';

//            return $params['alias'] . '.html';
        } else {
            return false;
        }
    }

    public function parseUrl($oManager, $oRequest, $sPathInfo, $sRawPathInfo) {
        $matches = explode('/', $sPathInfo);

        //search any page or not
        $page = array_search('page', $matches);
        if ($page) {
            $_GET['page'] = $matches[$page + 1];
            $_GET['matches'] = $sPathInfo;
        }

        $cat = array_search('cat', $matches);
        if ($cat) {
            $_GET['cat'] = $matches[$cat + 1];
        }

        if ($matches[0] == 'read' && $matches[1] == 'list') {
//            $alias = $matches[count($matches)-1];
            $_GET['id'] = $matches[2];
//            $_GET['alias'] = $alias;
            return 'article/viewList';
        } elseif ($matches[0] == 'reff') {
            $_GET['code'] = (isset($matches[1])) ? $matches[1] : '';
            return 'user/create';
        } elseif ($matches[0] == 'reff') {
            $_GET['code'] = (isset($matches[1])) ? $matches[1] : '';
            return 'bbiiMember/create';
        } elseif ($matches[0] == 'read') {
            $alias = $matches[count($matches) - 1];
            $_GET['alias'] = $alias;
            return 'article/viewByAlias';
        } elseif ($matches[0] == 'r') {
            $alias = $matches[count($matches) - 1];
            $_GET['alias'] = $alias;
            $_GET['access'] = 'login';
            return 'article/viewByAlias';
        } elseif ($matches[0] == 'detail') {
            $alias = $matches[count($matches) - 1];
            $_GET['alias'] = $alias;
            return 'product/viewByAlias';
        } elseif ($matches[0] == 'category') {
            if ($page) {
                $_GET['product_category_id'] = $matches[3];
            } else {
                $_GET['product_category_id'] = $matches[1];
            }
            $_GET['alias'] = 'category';
            return 'product/listProduct';
        } elseif ($matches[0] == 'productList') {
            $alias = $matches[count($matches) - 1];
            $_GET['alias'] = $alias;
            return 'product/viewList';
        } elseif ($matches[0] == 'bpnDocument') {
            return 'bpnDocument';
        } elseif ($matches[0] == 'form') {
            if ($matches[1] == 'create') {
                $_GET['menuParam'] = json_encode(array('form_category_id' => $matches[2]));
                return 'form/create';
            } elseif ($matches[1] == 'update') {
                $_GET['menuParam'] = json_encode(array('id' => $matches[2]));
                return 'form/update';
            } elseif ($matches[1] == 'delete') {
                $_GET['id'] = $matches[2];
                return 'form/delete';
            } else {
                if (isset($matches[2]))
                    $_GET['menuParam'] = json_encode(array('form_category_id' => $matches[2]));
                return 'form/index';
            }
        } elseif ($matches[0] == 'event' && isset($matches[1])) {
            $alias = $matches[1];
            $_GET['alias'] = $alias;
            return 'event/viewDetail';
        } elseif ($matches[0] == 'confirm-registration') {
            $_GET['id'] = $matches[1];
            return 'bbiiMember/confirmRegistration';
        } elseif ($matches[0] == 'forgot-password') {
//            $_GET['id'] = $matches[1];
            return 'bbiiMember/forgotPassword';
        } elseif ($matches[0] == 'change-password') {
            $_GET['id'] = $matches[1];
            return 'bbiiMember/changePassword';
        } elseif ($matches[0] == 'save-password') {
            $_GET['id'] = $matches[1];
            return 'bbiiMember/savePassword';
        } else {
            $arrRow = Menu::model()->find(array('condition' => 'alias="' . $matches[0] . '"'));
            if ($arrRow) {
//                $_GET['menu'] = ''; //get row menu place in a get variable
//                trace($arrRow);
                $_GET['title'] = $arrRow->name; //get row menu place in a get variable
                $_GET['access'] = $arrRow->access; //get row menu place in a get variable
                $_GET['menuParam'] = $arrRow->param; //get row menu place in a get variable
                $_GET['alias'] = $matches[0];
//            $_GET['param'] = $arrRow['param'];
                $oParam = json_decode($arrRow['param']);
//            $_GET['menu_id'] = $arrRow['id'];
                if ($arrRow['type'] == 'listArticle') {
                    $_GET['id'] = $oParam->article_category_id;
                    return 'article/viewList';
                } elseif ($arrRow['type'] == 'singleArticle') {
                    $_GET['id'] = $oParam->article_id;
                    return 'article/view';
                } elseif ($arrRow['type'] == 'portfolio') {
                    return 'portfolio';
                } elseif ($arrRow['type'] == 'testimonial') {
                    if (isset($matches[1])) {
                        return 'testimonial/captcha';
                    } else {
                        return 'testimonial';
                    }
                } elseif ($arrRow['type'] == 'contact') {
                    return 'contactUs';
                } elseif ($arrRow['type'] == 'blog') {
                    return 'article/viewBlog';
                } elseif ($arrRow['type'] == 'timeline') {
                    return 'article/viewTimeline';
                } elseif ($arrRow['type'] == 'payment') {
                    return 'payment';
                } elseif ($arrRow['type'] == 'referal') {
                    return 'mlm/referal';
                } elseif ($arrRow['type'] == 'downline') {
                    return 'mlm/downline';
                } elseif ($arrRow['type'] == 'bonus') {
                    return 'mlm/bonus';
                } elseif ($arrRow['type'] == 'flash') {
                    return 'game/gamePoker';
                } elseif ($arrRow['type'] == 'invoice') {
                    return 'invoices/index';
                } elseif ($arrRow['type'] == 'message') {
                    return 'userMessage/index';
                } elseif ($arrRow['type'] == 'request') {
                    return 'donation';
                } elseif ($arrRow['type'] == 'formTour') {
                    return 'formTour/create';
                } elseif ($arrRow['type'] == 'listRequst') {
                    return 'donation/listRequest';
                } elseif ($arrRow['type'] == 'listGive') {
                    return 'donation/listGive';
                } elseif ($arrRow['type'] == 'siteMap') {
                    return 'contactUs/siteMap';
                } elseif ($arrRow['type'] == 'deposit') {
                    if (isset($matches[1]) && $matches[1] == 'create') {
                        return 'saldoDeposit/create';
                    } else {
                        return 'saldoDeposit';
                    }
                } elseif ($arrRow['type'] == 'withdrawal') {
                    if (isset($matches[1]) && $matches[1] == 'create') {
                        return 'saldoWithdrawal/create';
                    } elseif (isset($matches[1]) && $matches[1] == 'view') {
                        return 'saldoWithdrawal/view';
                    } else {
                        return 'saldoWithdrawal';
                    }
                } elseif ($arrRow['type'] == 'transferSaldo') {
                    return 'transfer';
                } elseif ($arrRow['type'] == 'transferCoin') {
                    return 'mlmExchange';
                } elseif ($arrRow['type'] == 'historyTransfer') {
                    return 'transfer';
                } elseif ($arrRow['type'] == 'ticket') {
                    if (isset($matches[1]) && $matches[1] == 'create') {
                        return 'ticket/create';
                    } elseif (isset($matches[1]) && $matches[1] == 'view') {
                        return 'ticket/view';
                    } else {
                        return 'ticket';
                    }
                } elseif ($arrRow['type'] == 'sell') {
                    return 'sell';
                } elseif ($arrRow['type'] == 'invoice') {
                    return 'product/invoice';
                } elseif ($arrRow['type'] == 'chart') {
                    return 'product/viewcart';
                } elseif ($arrRow['type'] == 'checkout') {
                    return 'product/checkout';
                } elseif ($arrRow['type'] == 'listuser') {
                    return 'user/index';
                } elseif ($arrRow['type'] == 'user') {
                    if ($oParam->action_user == 'Registration') {
//                        $_GET['code'] = (isset($matches[1])) ? $matches[1] : '';
                        return 'bbiiMember/create';
                    } elseif ($oParam->action_user == 'Login') {
                        return 'site/login';
                    } elseif ($oParam->action_user == 'Logout') {
                        return 'site/logout';
                    } else {
                        $_GET['id'] = user()->id;
                        return 'user/update';
                    }
                } elseif ($arrRow['type'] == 'gallery') {
                    if ($cat) {
                        $_GET['gallery_category_id'] = $_GET['cat'];
                    } else {
                        $_GET['gallery_category_id'] = $oParam->gallery_category_id;
                    }
                    return 'gallery';
                } elseif ($arrRow['type'] == 'productCategory') {
                    if ($matches[0] == 'category') {
                        $_GET['product_category_id'] = $matches[count($matches) - 1];
                    } else {
                        $_GET['product_category_id'] = $oParam->product_category_id;
                    }
                    return 'product/listProduct';
                } elseif ($arrRow['type'] == 'event') {
                    return 'event';
                } elseif ($arrRow['type'] == 'eventCalender') {
                    return 'event/calender';
                } elseif ($arrRow['type'] == 'form') {
                    return 'form';
                } elseif ($arrRow['type'] == 'download') {
                    if ($cat) {
                        $_GET['download_category_id'] = $_GET['cat'];
                    } else {
                        $_GET['download_category_id'] = $oParam->download_category_id;
                    }
                    return 'download';
                } 
            } else {
//                return false;
                //trace($sPathInfo);
//                return $sPathInfo;
            }
        }

        return false;
    }

}

?>
