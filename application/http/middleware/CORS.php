<?php

namespace app\http\middleware;

class CORS
{

    public function handle($request, \Closure $next)
    {

        $domin=null;
        $origin=request()->header();
       
        if(!empty($origin['origin'])){
            switch ($origin['origin']) {
                case 'http://long.com':
                    $domin='http://long.com';
                    break;
                    case 'http://www.long.com':
                    $domin='http://www.long.com';
                    break;
                default:
                break;
            }
        }else{
            $domin='*';
        }
        if($domin){
            
            header('Access-Control-Allow-Origin:'.$domin);
            header("Access-Control-Allow-Headers: token, Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');
            header('Access-Control-Allow-Credentials: true');
            return $next($request);
        }else{
            return json([
                'msg'=>'非法请求'
            ]);
        }
        
    }
}
