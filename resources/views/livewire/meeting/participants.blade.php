<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Partisipan {{$data->name}}</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
  
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
  
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }

        body, html {
            height: 100%;
            margin: 0;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
  
</head>
{{-- <body class="bg-dark"> --}}
    <body background="{{asset('images/bg.png')}}">
<div class="container">
   <div class="row">
       <div class="col-md-6 offset-md-3 mt-5  col-xs-12">
           <div class="card">
               <div class="card-header">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%">
                                <img width="50" height="50" src="{{ asset('images/logo2.png') }}" alt="" srcset="">
                            </td>
                            <td style="text-align: center; vertical-align:middle;">
                                <h5>{{$data->name}}</h5>
                            </td>
                        </tr>
                    </table>
               </div>
               <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{route('partisipan.upload',$data->slug)}}"
                     enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                           
                            <div class="form-group">
                                <label >Asal</label>
                                <select  id="origin" name="origin" onchange="myFunction()"
                                    class="form-control">
                                    <option value="1" {{old('origin')==1 ? 'selected' : ''}}>Badan POM</option>
                                    <option value="2" {{old('origin')==2 ? 'selected' : ''}}>Instansi Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Nama Lengkap</label>
                                <input type="text" class="form-control"  name="nama_lengkap"
                                placeholder="Enter Nama Lengkap" value="{{old('nama_lengkap')}}">
                            </div>
                            <div class="form-group" id="unit">
                                <label >Unit Kerja</label>
                                <input type="text" class="form-control"  name="unit_kerja"
                                placeholder="Enter Unit Kerja" value="{{old('unit_kerja')}}">
                            </div>
                            <div class="form-group" id="instansi">
                                <label >Nama Perusahaan / Instansi</label>
                                <input type="text" class="form-control"  name="name_instansi"
                                placeholder="Enter Nama Instansi" value="{{old('name_instansi')}}">
                            </div>
                            <div class="form-group">
                                <label >Jabatan</label>
                                <input type="text" class="form-control"  name="jabatan"
                                placeholder="Enter Jabatan" value="{{old('jabatan')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Kehadiran</label>
                                <select  id="tipe" name="tipe"
                                class="form-control">
                                <option value="L" {{old('tipe')=='L' ? 'selected' : ''}}>Luring</option>
                                <option value="D" {{old('tipe')=='D' ? 'selected' : ''}}>Daring</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="" for="">Tanda Tangan:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <br/>
                        <div class="col-md-12">
                            <button class="btn btn-large btn-block btn-primary" type="submit">SUBMIT</button>
                            
                        </div>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#unit").show();
        $("#instansi").hide();
    });

    $("#origin").on("change", function(){
        var v = $(this).val();
        if(v=="1"){
            $("#unit").show();
            $("#instansi").hide();
        }else{
            $("#unit").hide();
            $("#instansi").show();
        }         
    });             

    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
</body>
</html>
