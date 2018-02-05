
<?php
/**
 * Created by PhpStorm.
 * FileName versionTwoToMd.php
 * User: cathw <cath258@qq.com>
 * Date: 2018/2/5 18:01
 */
include 'conversion.class.php';

// 生成markdown表格形式
function generate($sqlData){
    $fileName = date('YmdHis').'.md';
    file_put_contents($fileName, '# 数据库文档'. "\r\n", FILE_APPEND);
    file_put_contents($fileName, '<a name="返回顶部"></a>'. "\r\n", FILE_APPEND);
    file_put_contents($fileName, '## 数据库目录'. "\r\n", FILE_APPEND);
    foreach ($sqlData as $k => $v) {
        file_put_contents($fileName, '* ['. $k .'()](#'. $k .'_pointer)'. "\r\n", FILE_APPEND);
    }
    file_put_contents($fileName, '## 数据表说明'. "\r\n", FILE_APPEND);
    file_put_contents($fileName, "\r\n", FILE_APPEND);


    foreach($sqlData as $k => $v ){

        $priField = null;
        $uniField = null;
        if(array_key_exists('_pk',$v['field'])) $priField = $v['field']['_pk'];
        if(array_key_exists('_unique',$v['field'])) $uniField = $v['field']['_unique'];

        file_put_contents($fileName, '<a name="'.$k.'_pointer"></a>'."\r\n", FILE_APPEND);
        file_put_contents($fileName, '* '.$k.'[↑](#返回顶部)'. "\r\n\r\n", FILE_APPEND);
        file_put_contents($fileName, '| Field | Type | Null | Key | Default | Comment |'. "\r\n", FILE_APPEND);
        file_put_contents($fileName, '|---|---|---|---|---|---|'."\r\n", FILE_APPEND);

        foreach($v['field'] as $kk => $vv){

            if($kk == '_unique' || $kk == '_pk') continue;

            // 输出markdown格式表格
            $content = '|'.$kk.'|'.($vv['type'].($vv['unsigned']?' unsigned':'')).'|'.($vv['NULL']?'NULL':'NOT NULL').'|'.  ($kk == $priField ? 'PRI' : '') . ($kk == $uniField ? 'UNI' : '') .'|'.$vv['Default'].'|'.$vv['Comment'].'|';
            file_put_contents($fileName, $content . "\r\n", FILE_APPEND);

        }
        // 输出表引擎以及表字符集
        file_put_contents($fileName, "存储引擎：".$v['tableInfo']['engine'].' &nbsp;字符集：'.$v['tableInfo']['charset'] . "\r\n", FILE_APPEND);
        file_put_contents($fileName, "\r\n", FILE_APPEND);
    }
    echo 'success';
}


$cs = (new conversion('test.sql'))->handleStructure();

generate($cs);
