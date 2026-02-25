<?php
define('alphabet',['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f']);
function index(){$in=0;$res=[];
	foreach(alphabet as $k => $v){
		foreach(alphabet as $kk => $y)array_push($res,$v.$y);
	};return $res;
};
function num($int,$base=2){return base_convert($int,$base,10);
};
function str($str,$base=2){return base_convert($str,10,$base);
};
function sT($string){$new_str_0='';$new_str_1=str_split($string,8);
	foreach($new_str_1 as $res){$new_str_0.=pack('H8', base_convert($res,2,16));
	};return $new_str_0;
};
function sB($string){$String='';
    for($i=0;$i<strlen($string);$i++){
        $String.=str_pad(decbin(ord($string[$i])),8,'0',STR_PAD_LEFT);
    };return $String;
};
class Uint8Array{
	public $array=[],$result,$buffer,$length=0;
	function __construct($array,$length=0){
		$this->array=$array;$this->buffer=implode(',',$this->array);
		if(count($array)){
			for($k=0;$k<count($this->array);$k++){$st=intval($this->array[$k]);
				$this->array[$k]=abs($st%256);
			};
		}else{$this->array=array_fill(0,$length,0);
		};$this->buffer=implode(',',$this->array);$this->length=count($this->array);
	}
};
class TextEncoder{
	public $txt,$array=[];
	function encode($str=''){
		$this->txt=str_split(sB($str),8);
		foreach($this->txt as $k => $v)array_push($this->array,num($v));
		return new Uint8Array($this->array);
	}
};
class TextDecoder{
	public $txt,$array=[];
	function decode($txt=[]){
		try{$this->txt=json_decode(json_encode($txt,true),true);
			foreach($this->txt['array'] as $k => $v)array_push($this->array,str_pad(str($v),8,'0',STR_PAD_LEFT));
			return sT(implode('',$this->array));
		}catch(exception $e){return 'not valid Uint8Array';
		}
	}
};
class TextEncoderUTF8{
	public $txt,$array=[],$arr;
	function __construct(){$this->arr=index();
	}function encode($txt=''){
		$this->txt=str_split(bin2hex($txt),2);
		foreach($this->txt as $k => $v)array_push($this->array,array_search($v,$this->arr));
		return new Uint8Array($this->array);
	}
};
class TextDecoderUTF8{
	public $txt,$array=[],$arr,$text=[],$result='';
	function __construct(){$this->arr=index();
	}function decode($txt=[]){
		try{$this->txt=json_decode(json_encode($txt,true),true);
			if(!$this->txt['array'])return 'not valid Uint8Array';
			$this->array=$this->txt['array'];
			foreach($this->array as $k => $v)array_push($this->text,$this->arr[$v]);
			$this->result=hex2bin(implode('',$this->text));
			return $this->result;
		}catch(exception $e){return 'not valid Uint8Array';
		}
	}
};
?>
