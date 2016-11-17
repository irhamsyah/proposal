<html>
  <head>
    <title>To-do List Application</title>
    <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('css/signin.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/docs.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/bootstrap-responsive.css') }}" rel="stylesheet">    
<link href="{{ URL::to('css/prettify.css') }}" rel="stylesheet">
    <link href="{{ url('css/styles.css') }}" rel="stylesheet">
    <!--[if lt IE 9]><script
      src = "//html5shim.googlecode.com/svn/trunk/html5.js">
      </script><![endif]-->
 <style type="text/css">
        select{
            background-color:#F00;
            width: 200px;
        }
    </style>
  </head>
  <body>
    <div class="container">
      <section id="data_section" class="todo">
        <ul class="todo-controls">
        <li><img src="{{url('img/add.png')}}" width="14px"  onClick="show_form('add_task');" /></li>
        </ul>
          <ul id="task_list" class="todo-list">
          @foreach($todos as $key=>$todo)
            @if($todo->status)
              <li id="{{$todo->id}}" class="done">
                <a href="#" class="toggle"></a>
                <span id="span_{{$todo->id}}">{{$todo->title}}</span> <a href="#" onClick="delete_task('{{$todo->id}}');"
                                                                         class="icon-delete">Delete</a> <a href="#"
                onClick="edit_task('{{$todo->id}}','{{$todo->title}}');"
                class="icon-edit">Edit</a></li>
            @else
              <li id="{{$todo->id}}"><a href="#" onClick="task_done('{{$todo->id}}');"class="toggle"></a> 
              <span id="span_{{$todo->id}}">{{$todo->title}}</span>
              <a href="#" onClick="delete_task('{{$todo->id}}');" class="icon-delete">Delete</a>
              <a href="#" onClick="edit_task('{{$todo->id}}','{{$todo->title}}');"class="icon-edit">Edit</a></li>
            @endif
          @endforeach
        </ul>
      </section>
      <section id="form_section">
      
      <form id="add_task" class="todo"
        style="display:none">
      <input id="task_title" type="text" name="title"
        placeholder="Enter a task name" value=""/>
      <button name="submit">Add Task</button>
      </form>

        <form id="edit_task" class="todo"
          style="display:none">
        <input id="edit_task_id" type="hidden" value="" />
        <input id="edit_task_title" type="text"
          name="title" value="" />
        <button name="submit">Edit Task</button>
      </form>

    </section>
    
    </div>
    <script src = "//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
    <script src = "assets/js/todo.js" type="text/javascript"></script>
  </body>
</html>