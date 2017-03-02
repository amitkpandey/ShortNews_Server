@extends('../layouts.admin')
@section('title','Default Image Index')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-14">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Category List</h3>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Page Logo</th>
                                <th>Video Tag Image</th>
                                <th>Title Color</th>
                                <th>video tag color</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            if($listData){
                                $labeClass = "label-success";
                                $labeName = "Active";
                                foreach ($listData as $list){

                                    $delete_url = url()->current().'?page='.$page.'&delete=true&id='.$list['id'];
                                    $edit_url = url()->current().'?page='.$page.'&isEdit=true&id='.$list['id'];;

                                    if($list['active'] == 0){
                                        $class = "danger";
                                        $active_url =url()->current().'?page='.$page.'&active=1&id='.$list['id'];
                                        $status_button = '<a href='.$active_url.'  class=" col-sm-4 btn btn-sm btn-success btn-flat pull-left">Active</a>';
                                    }else{
                                        $class = "";
                                        $active_url =url()->current().'?page='.$page.'&active=0&id='.$list['id'];
                                        $status_button = '<a href='.$active_url.'  class=" col-sm-4 btn btn-sm btn-warning btn-flat pull-left">Deactive</a>';
                                    }
                                    echo '<tr class="'.$class.'">';
                                    echo '<td>'.$list['id'].'</td>';
                                    echo '<td class="col-md-2">'.$list['name'].'</td>';
                                    echo '<td><img width="100" height="100" src="'.$list['paper_logo'].'"></td>';
                                    echo '<td><img width="100" height="100" src="'.$list['video_tag_image'].'"></td>';
                                    echo '<td><label style="color: '.$list['title_color'].'">'.$list['title_color'].'</label></td>';
                                    echo '<td><label style="color: '.$list['paper_tag_color'].'">'.$list['paper_tag_color'].'</label></td>';

                                    $labeClass = $list['active']?"label-success" : "label-danger";
                                    $labeName = $list['active']?"Active" : "Block";


                                    echo '<td><span class="label '.$labeClass.'">'.$labeName.'</span></td>';
                                    echo '<td><a href="'.$edit_url.'" class=" col-sm-3 btn btn-sm btn-info btn-flat pull-left">Edit</a>
                                          '.$status_button.'
                                          <a href= "'.$delete_url.'" class="col-sm-3 btn btn-sm btn-danger btn-flat pull-left">Delete</a>
                                          </td>';
                                    echo '<tr>';

                                }
                            }
                            ?>


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                {{$listData->links()}}
            </div>
        </div>
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo Form::open(array('route'=> $router['POST'],'method'=>'post','enctype'=>'multipart/form-data')) ?>
                {{--<form role="form">--}}
                <div class="box-header with-border">
                    <h3 class="box-title">New Category</h3>
                    @if (count($errors) > 0)
                        <div class="alert alert-success">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    @if(strpos($error,'Successful!'))
                                        <li style="color: #FFFFFF">{{ $error }}</li>
                                    @else
                                        <li style="color: red">{{ $error }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Newspaper Name</label>
                        <input type="input" name ="name" value = "<?php echo $update_data!=null?$update_data["name"]:""; ?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title color</label>
                        <input type="input" name ="title_color" value = "<?php echo $update_data!=null?$update_data["title_color"]:""; ?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Paper Tag color</label>
                        <input type="input" name ="paper_tag_color" value = "<?php echo $update_data!=null?$update_data["paper_tag_color"]:""; ?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pager Logo</label>
                        <input type="file" name ="paper_logo" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Video Tag Image</label>
                        <input type="file" name ="video_tag_image" class="form-control" id="exampleInputEmail1" >
                    </div>

                    <div class="checkbox">
                        <label>
                            @if($update_data!=null & $update_data['active'] != 1)
                                <input type="checkbox" name="active" > Active
                            @else
                                <input type="checkbox" name="active" checked > Active
                            @endif
                            @if($isEdit)
                                <input type="hidden" name = "id" value="<?php echo $update_data['id']?>">
                            @endif
                        </label>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @if($isEdit)
                        &nbsp;&nbsp;&nbsp;&nbsp<a href="<?php echo url()->current() ?>" class="btn btn-warning" >Cancel</a>
                    @endif
                </div>
                <?php echo Form::close() ?>
            </div>
            <!-- /.box -->
@endsection
