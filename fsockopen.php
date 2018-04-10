<?php
/**
 * @Author: jsy135135
 * @email:732677288@qq.com
 * @Date:   2018-04-10 21:04:19
 * @Last Modified by:   jsy135135
 * @Last Modified time: 2018-04-11 00:47:10
 */
// 自定义错误处理函数
function myErrorHandler($errno,$errstr,$errfile,$errline){
  // throw new Exception("$errno,$errstr", 1);
}
set_error_handler('myErrorHandler');
// 检测端口是否监听
function phpPingByPort($portArray)
{
  // 接收IP参数
  fwrite (STDOUT, '请输入要检测的ip'.PHP_EOL);
  $ip = trim(fgets(STDIN));
  if(filter_var($ip, FILTER_VALIDATE_IP)) {
  // it's valid
    // 循环遍历端口
    foreach ($portArray as $key => $value) {
      try{
        if(fsockopen($ip, $value, $errno, $errstr, 10)){
          echo 'port:'.$value.' is up'."\n";
        }
        else{
          throw new Exception('port:'.$value.' is down'."\n");
        }
      }catch(Exception $e){
        echo $e->getMessage();
      }
    }
  }else{
    echo '请输入合法的IP!';
  }
}
// 添加常见端口
$portArray = array(22,80,8080,3306,11211,6379,27017);
phpPingByPort($portArray);