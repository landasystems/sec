<div id="file-uploader"></div>
 
<?php
 
$filesPath = realpath(param('pathImg').'/'.user()->code.'/');
$filesUrl = param('urlImg').'/'.user()->code.'/';
 
$this->widget("common.extensions.ezzeelfinder.ElFinderWidget", array(
    'selector' => "div#file-uploader",
    'clientOptions' => array(
//        'lang' => "id",
        'resizable' => false,
        'wysiwyg' => "ckeditor",
        'debug'=>TRUE,
        
    ),
    'connectorRoute' => "fileManager/fileUploaderConnector",
    'connectorOptions' => array(
        'roots' => array(
            array(
                'driver'  => "LocalFileSystem",
                'path' => $filesPath,
                'URL' => $filesUrl,
                'tmbPath' => $filesPath . DIRECTORY_SEPARATOR . ".thumbs",
                'mimeDetect' => "internal",
//                'accessControl' => "rights"
            )
        )
    )
));


?>

<br/>
<div class="well">
    <ul>
        <li>Maximal file upload 1 MB</li>
        <li>Halaman ini merupakan file manager untuk akun Anda, didalam area ini anda dapat melakukan operasi file (Upload, Tambah, Edit, Hapus, Preview, Rename, dll)</li>
        <li><strong>Catatan</strong> : Setelah upload mohon klik kanan dan pilih reload.</li>
    </ul>
</div>