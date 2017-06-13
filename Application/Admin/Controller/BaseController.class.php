<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function _initialize(){

        if(session('username') == null || session('roleid') == null){
            $this->error("登陆超时，请再次登陆~",'/admin/login');
        }
    }




    public function downtest($filename,$image)
    {
        //下面是实例操作过程：
        $dfile = tempnam('/tmp', 'tmp');//产生一个临时文件，用于缓存下载文件
//        $zip = new zipfile();
//----------------------
        $filename = $filename; //下载的默认文件名

//以下是需要下载的图片数组信息，将需要下载的图片信息转化为类似即可
//        $image = array(
//            array('image_src' => 'public/Uploads/2017-05-07/590f1f5ae55e7.jpg', 'image_name' => '图片1.jpg'),
//            array('image_src' => 'public/Uploads/2017-05-07/590f21b3b9114.jpg', 'image_name' => 'pic/图片2.jpg'),
//        );

        foreach($image as $v){

            $this->add_file(file_get_contents("public/Uploads/".$v['pic']), mb_convert_encoding($v['name'], "GBK").$v['idcard'].'.jpg');
            // 添加打包的图片，第一个参数是图片内容，第二个参数是压缩包里面的显示的名称, 可包含路径
            // 或是想打包整个目录 用 $zip->add_path($image_path);
        }
//----------------------
        $this->output($dfile);

// 下载文件
        ob_clean();
        header('Pragma: public');
        header('Last-Modified:'.gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control:no-store, no-cache, must-revalidate');
        header('Cache-Control:pre-check=0, post-check=0, max-age=0');
        header('Content-Transfer-Encoding:binary');
        header('Content-Encoding:none');
        header('Content-type:multipart/form-data');
        header('Content-Disposition:attachment; filename="'.$filename.'"'); //设置下载的默认文件名
        header('Content-length:'. filesize($dfile));
        $fp = fopen($dfile, 'r');
        while(connection_status() == 0 && $buf = @fread($fp, 8192)){
            echo $buf;
        }
        fclose($fp);
        @unlink($dfile);
        @flush();
        @ob_flush();
        exit();
    }


    var $datasec = array ();
    var $ctrl_dir = array ();
    var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00";
    var $old_offset = 0;

    function unix2_dostime($unixtime = 0){
        $timearray = ($unixtime == 0) ? getdate () : getdate($unixtime);
        if ($timearray ['year'] < 1980){
            $timearray ['year'] = 1980;
            $timearray ['mon'] = 1;
            $timearray ['mday'] = 1;
            $timearray ['hours'] = 0;
            $timearray ['minutes'] = 0;
            $timearray ['seconds'] = 0;
        }
        return (($timearray ['year'] - 1980) << 25) | ($timearray ['mon'] << 21) | ($timearray ['mday'] << 16) | ($timearray ['hours'] << 11) | ($timearray ['minutes'] << 5) | ($timearray ['seconds'] >> 1);
    }
    function add_file($data, $name, $time = 0){
        $name = str_replace('\\', '/', $name);

        $dtime = dechex($this->unix2_dostime($time));
        $hexdtime = '\x' . $dtime [6] . $dtime [7] . '\x' . $dtime [4] . $dtime [5] . '\x' . $dtime [2] . $dtime [3] . '\x' . $dtime [0] . $dtime [1];
        eval('$hexdtime = "' . $hexdtime . '";');

        $fr = "\x50\x4b\x03\x04";
        $fr .= "\x14\x00";
        $fr .= "\x00\x00";
        $fr .= "\x08\x00";
        $fr .= $hexdtime;

        $unc_len = strlen($data);
        $crc = crc32($data);
        $zdata = gzcompress($data);
        $zdata = substr(substr($zdata, 0, strlen($zdata)- 4), 2);
        $c_len = strlen($zdata);
        $fr .= pack('V', $crc);
        $fr .= pack('V', $c_len);
        $fr .= pack('V', $unc_len);
        $fr .= pack('v', strlen($name));
        $fr .= pack('v', 0);
        $fr .= $name;

        $fr .= $zdata;
        $fr .= pack('V', $crc);
        $fr .= pack('V', $c_len);
        $fr .= pack('V', $unc_len);

        $this->datasec [] = $fr;

        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .= "\x00\x00";
        $cdrec .= "\x14\x00";
        $cdrec .= "\x00\x00";
        $cdrec .= "\x08\x00";
        $cdrec .= $hexdtime;
        $cdrec .= pack('V', $crc);
        $cdrec .= pack('V', $c_len);
        $cdrec .= pack('V', $unc_len);
        $cdrec .= pack('v', strlen($name));
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('V', 32);

        $cdrec .= pack('V', $this->old_offset);
        $this->old_offset += strlen($fr);

        $cdrec .= $name;

        $this->ctrl_dir[] = $cdrec;
    }
    function add_path($path, $l = 0){
        $d = @opendir($path);
        $l = $l > 0 ? $l : strlen($path) + 1;
        while($v = @readdir($d)){
            if($v == '.' || $v == '..'){
                continue;
            }
            $v = $path . '/' . $v;
            if(is_dir($v)){
                $this->add_path($v, $l);
            } else {
                $this->add_file(file_get_contents($v), substr($v, $l));
            }
        }
    }
    function file(){
        $data = implode('', $this->datasec);
        $ctrldir = implode('', $this->ctrl_dir);
        return $data . $ctrldir . $this->eof_ctrl_dir . pack('v', sizeof($this->ctrl_dir)) . pack('v', sizeof($this->ctrl_dir)) . pack('V', strlen($ctrldir)) . pack('V', strlen($data)) . "\x00\x00";
    }

    function add_files($files){
        foreach($files as $file){
            if (is_file($file)){
                $data = implode("", file($file));
                $this->add_file($data, $file);
            }
        }
    }
    function output($file){
        $fp = fopen($file, "w");
        fwrite($fp, $this->file ());
        fclose($fp);
    }

}