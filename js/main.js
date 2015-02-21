var homeModule = {
    fetch: function() {
        $('#bod').load('home/').show();
    }
};
var clientModule = {
    fetch: function() {
        $('#bod').load('client/?id=' + this.id).show();
    },
    fetchAll: function() {
        $('#bod').load('client/').fadeIn();
    },
    newModule: function() {
        $('#bod').load('client/new').show();
    },
    saveModule: function() {
        $('#bod').load('client/submit/').show();
    },
    editModule: function() {
        $('#bod').load('client/edit/?id=' + this.id).show();
    }
};
var todoModule = {
    fetch: function() {
        $('#bod').load('todo/?id=' + this.id).show();
    },
    fetchAll: function() {
        $('#bod').load('todo/').fadeIn();
    },
    newModule: function() {
        $('#bod').load('todo/new/?id='+this.id).show();
    },
    newCModule: function() {
        $('#bod').load('todo/new/?id=' + this.id).show();
    },
    editModule: function() {
        $('#bod').load('todo/edit/?id=' + this.id).show();
    }
};
var locID;
var timesheetModule = {
    fetch: function() {
        $('#bod').load('timesheet/').show();
    }
};
var projectModule = {
    fetch: function() {
        $('#bod').load('projects/?id=' + this.id).show();
        locID = this.id;
    },
    fetchAll: function() {
        $('#bod').load('projects/').fadeIn();
    },
    newModule: function() {
        $('#bod').load('projects/new').show();
    },
    deleteModule: function() {
        $('#bod').load('projects/delete/?id='+this.id).show();
    },
    newCModule: function() {
        $('#bod').load('projects/new/?id=' + this.id).show();
    },
    editModule: function() {
        $('#bod').load('projects/edit/?id=' + this.id).show();
    }
};

// -------------PROJECTS
$.routes.add('/projects/new', projectModule.newModule);
$.routes.add('/projects/edit/{id:int}/', projectModule.editModule);
$.routes.add('/projects/new/{id:int}/', projectModule.newCModule);
$.routes.add('/projects/{id:int}/', projectModule.fetch);
$.routes.add('/projects/', projectModule.fetchAll);
$.routes.add('/projects/', projectModule.fetchAll);
// -------------ToDo
$.routes.add('/todo/new/{id:int}/', todoModule.newModule);
$.routes.add('/todo/edit/{id:int}/', todoModule.editModule);
$.routes.add('/todo/{id:int}/', todoModule.fetch);
$.routes.add('/todo/', todoModule.fetchAll);
// -------------Clients
$.routes.add('/client/new', clientModule.newModule);
$.routes.add('/client/edit/{id:int}/', clientModule.editModule);
$.routes.add('/client/{id:int}/', clientModule.fetch);
$.routes.add('/client/', clientModule.fetchAll);
// -------------Timesheets
$.routes.add('/timesheet/', timesheetModule.fetch);
// -------------HOME
$.routes.add('/', homeModule.fetch);
$.routes.add('/dash', homeModule.fetch);


var makeBox = 0;
$(document).on('click',"#addNewToDo",function(e){
    //var foo = $('.list-group-item.disabled');
    if(makeBox == 0){
        makeBox=1;
        var foo = $('#addHere');
        var iddd =window.location.hash.split(/[//]/)[2];
            var toAdd = "<form id='newProject' class='newToDo' action='todo/submit/index.php'><li class='list-group-item'><input name='Name' type='text' /><input name='id' type='hidden' value='"+iddd+"'/><input  type='submit' /><input type='button' class='cancelInsert' value='x'/></li></form>";
            foo.before(toAdd);
    };
});
//checkbox handler
$(document).on('click',".cancelInsert",function(e){
    $('.newToDo').remove();
    makeBox = 0;
});
$(document).on('focus',".pickDate", function(){
        $(this).datetimepicker({format:'Y-m-d H:i:s'});
});
$(document).on('click',"#deleteClient",function(e){
    var x;
    var iddd =window.location.hash.split(/[//]/)[2];
    if (confirm("Are you sure you want to delete [client]? \n this will also delete all related projects and todo items") == true) {
    $.post( "client/delete/",{id : iddd, action: 'delete'}, function(result) {
                                   window.location.hash = "#/client/";
                                   console.log(result);
    })
    .fail(function() {
        console.log(result);
    })
    }
});
$(document).on('click',"#deleteProject",function(e){
    var x;
    var iddd =window.location.hash.split(/[//]/)[2];
    if (confirm("Are you sure you want to delete [project]? \n this will also delete all todo items") == true) {
    $.post( "projects/delete/",{id : iddd, action: 'delete'}, function(result) {
                                   window.location.hash = "#/projects/";
                                   console.log(result);
    })
    .fail(function() {
        console.log(result);
    })
    }
});
$(document).on('click',".todo-item",function(e){
    var idd = $(this).parent().attr('id');
    if($(this).prop('checked')){
        var act = 'complete';
    }else{
        var act = 'uncomplete';
    }
    $.get( "todo/delete/",{id : idd, action: act}, function(result) {
        $('#bod').load('projects/?id=' + locID).show();
//        console.log(result);
    })
    .fail(function() {
        console.log(result);
    })
});
//Form Handler (AJAXifies any form with the id #newproject)
$(document).on('click',"#newProject input[type=submit]",function(e)
               {
                   makeBox = 0;
                   e.preventDefault(); //STOP default action
                   var postData = $('#newProject').serializeArray();
                   var formURL = $('#newProject').attr("action");
                   $.ajax(
                       {
                           url : formURL,
                           type: "POST",
                           data : postData,
                           success:function(data, textStatus, jqXHR)
                           {
                               //data: return data from server
                               console.log(data);
                               if(data == window.location.hash){
                                   window.location.hash = "#/a";
                               }
                               window.location.hash = data;
                           },
                           error: function(jqXHR, textStatus, errorThrown)
                           {
                               //if fails
                               alert('fail');
                           }
                       });
               });


