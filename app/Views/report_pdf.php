<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>


    
    <style>
        @page{
            margin:30px;
        } 

        .img-header{    
            width: 100px;
            float: left;
            padding : 0 0 0 90px; 
        }
        .header-title{  
            text-align: left;
            font-size: 23px;
            width:500px; 
            float: left;
            padding : 0px 0 0 20px;  
        }
        .header-title span{   
            font-size: 14px;  
            font-weight:none;
        }
        .hr-title{
            margin-top:-5px;
            clear:both;
        }
        .h4-text-title{
            text-align: center;
            margin: 10px 0 10px 0;
            letter-spacing: 1px;
        }

        /*  */

        .table{ 
            width:100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            margin-bottom: 60px;

        }
        .table td, .table th {
            border: 1px solid #A0A0A0;
            padding: 8px;
        }
        .table th {   
            font-size: 13px;


        }
        .table tr:nth-child(even){background-color: #f2f2f2;}

    </style>




</head>
<body> 
        <div class="img-header">
            <img src="<?=base_url()?>/assets/images/logo-removebg-preview.png" alt="SI-FUTSAL LOGO" style="width:100%;" > 
        </div>
        <h1 class="header-title">
            SISTEM CUTI ONLINE<br>
            <span class="">Biro Perekonomian dan Administrasi Pembangunan Setda Provinsi Bali</span>
        </h1> 
        <hr class="hr-title">
        <h4 class="h4-text-title"  >Laporan Cuti</h4> 
        <br>  
        <table>
            <tr>
                <td style="width:100px;">Bulan</td>
                <td>: <?=$date?></td>
            </tr> 
        </table>
        
        <table class="table">  
            <thead>
                <tr>
                    <th >No</th>  
                    <th >Nama</th> 
                    <th >Kategori<br>Cuti</th> 
                    <th >Tanggal<br>Pengajuan</th> 
                    <th >Tanggal<br>Berakhir</th> 
                    <th >Deskripsi</th> 
                    <th >Status</th>  
                </tr> 
            </thead>  
            <tbody>   
                <?php $no=0; foreach ($getCuti as $key => $value) : $no++;  ?>
                    
                    <tr>
                        <td ><?=$no?></td>  
                        <td ><?=$value->full_name_pegawai?></td> 
                        <td ><?=$value->nama_categori_cuti?></td> 
                        <td ><?=$value->tgl_pengajuan?></td> 
                        <td ><?=$value->tgl_berakhir?></td> 
                        <td ><?=$value->descripsi_cuti?></td> 
                        <td ><?=($value->status_cuti == 1)? '<b style="color:green">Approve</b>' : '<b style="color:red">Not Approve</b>' ?></td> 
                    </tr> 
                     
                <?php endforeach; ?>
            </tbody>
        </table>











        <script type="text/php">
                if ( isset($pdf) ) {
                    // OLD 
                    // $font = Font_Metrics::get_font("helvetica", "bold");
                    // $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(255,0,0));
                    // v.0.7.0 and greater
                    $x = 250;
                    $y = 810;
                    $text = "SIPORT Page ({PAGE_NUM} of {PAGE_COUNT}) ";
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "bold");
                    $size = 6;
                    $color = array(0,0,0);
                    $word_space = 0.0;  //  default
                    $char_space = 0.0;  //  default
                    $angle = 0.0;   //  default
                    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
                }
            </script>


 

</body>
</html>