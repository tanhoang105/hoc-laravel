<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
</head>
<body>
     <div class="container">
          <div class="row">
               <form action="" method="post">
                    <div class="form-group">
                         <label for="">Tên sẩn phẩm </label>
                         <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId"><br>
                         <input type="text" name="_token" value="<?= csrf_token() ?>"><br>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm</button>
               </form>
               
          </div>
     </div>
</body>
</html>