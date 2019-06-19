<?php
/**
 * Created by PhpStorm.
 * User: 84333
 * Date: 2019/4/14
 * Time: 0:56
 */

namespace app\login\controller;

use app\logmanage\model\Log as LogModel;
use think\Controller;
use think\Db;
use app\login\model\Mobile as Suibian;

//http://localhost/ss_calendar_new/public/index.php/login/rstlogin/index
class Rstlogin extends Controller
{
	/**
	 * �ⵤ��
	 * ���ܣ��޸�����
	 * @return view
	 */
	public function resetpwd($tel, $password)
	{
		 $data = Db::name('manage_info')->where('telephone', $tel)->update(['password' => $password]);//�޸�����
		 return $data;
	}
	
	 public function index()
	{
	        if (request()->isAjax()) {
	            $password = trim(input('password'));
				$tel = trim(input('tel'));
				$code = trim(input('code'));
	            //$password_confirm = trim(input('password_confirm'));
	
	            //��֤��������ȷ
	            if ( !empty($tel) && !empty($code) && $tel == cookie('tel') && $code == cookie('Code')){
					
             if(resetpwd($tel,$password)==1){
	             
	                $msg=['status'=>0,'msg'=>'�����޸ĳɹ�'];
	                return json($msg);
					}else{
	                //$msg=['status'=>0,'msg'=>'��½�ɹ�'];
	                $msg=['status'=>1,'msg'=>'�����޸�ʧ��'];
	                return json($msg);
	            }
	            }else{
	                //$msg=['status'=>0,'msg'=>'��½�ɹ�'];
	                $msg=['status'=>2,'msg'=>'��֤�����'];
	                return json($msg);
	            }
				
	        }
	        else{
	            //echo 'aaaaa';
	        }
	        return $this->fetch();
	        //return view();
	    }

    /**
     * �ⵤ��
     * ���ܣ��ж��Ƿ�Ϊ����Ա�����Ͷ���
     */
    public function sendCode(){
        //dump("sendCOde");
        //dump('sendCone');
        if (request()->isAjax()){
            /* ǰ�˵ĵ绰���� */
            $tel=trim(input('phoneNum'));

            /* �ж��Ƿ�Ϊ����Ա���� */
            $def = new Suibian();
            $is_manager = $def -> hasMobile($tel);

            /* �ǹ���Ա���Ͷ��� */
            if($is_manager){
//                $msg=['status'=>0,'msg'=>'�ǹ���Ա'];
//                return json($msg);
                $code = mt_rand(10000,99999);
                $res = $this->aip($tel,$code);
                if($res == 0){
                    cookie('tel',$tel,60);
                    cookie('Code',$code,60);
                    $msg=['status'=>0,'msg'=>'���ŷ��ͳɹ�'];
                    return json($msg);
                }else{
                    cookie('tel', null);
                    cookie('Code', null);
                    $msg=['status'=>$res,'msg'=>'���ŷ���ʧ��'];
                    return json($msg);
                }
            }else{
                //echo '���ǹ���Ա';
                $msg=['status'=>1,'msg'=>'�ú��벻��ȷ'];
                return json($msg);
            }
        }
    }

    /**
     * �ⵤ��
     * ���ܣ���������� API �����ű������Ͷ���
     * @return  ������ƽ̨���صĽ��
     */
    public function aip($tel,$code,$time = 1){

        $smsapi = "http://www.smsbao.com/"; //��������
        $user = "annora"; //����ƽ̨�ʺ�
        $pass = md5("370682"); //����ƽ̨����
        $content="��������΢��������֤��Ϊ{$code}���뾡�����룡";//Ҫ���͵Ķ�������
        $phone = $tel;
        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        $result =file_get_contents($sendurl) ;
        return $result;
    }
}