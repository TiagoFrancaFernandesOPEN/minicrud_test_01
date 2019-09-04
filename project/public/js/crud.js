PROFILE_TYPES =
jQuery.ajax({
  url: BASE_URL_API + 'profiles',
  type: 'GET',
  success: function (data) {
    PROFILE_TYPES = data;
  }
});
function profileById(id){
  id = parseInt(id);
  id = (id >= PROFILE_TYPES.length || id < 0 )?PROFILE_TYPES.length - 1: id-1;
  return PROFILE_TYPES[id].profile_type;
}

function addLine(obj){
  console.log(profileById(obj.user_profile));
  var profile_name=profileById(obj.user_profile);
  console.log(profile_name);
  var line = "<tr id='trId_" + obj.user_id+"'>"+
  "    <td>"+obj.user_id+"</td>"+
  "    <td>"+obj.user_fullname+"</td>"+
  "    <td>"+obj.user_email+"</td>"+
  "    <td>"+profile_name+"</td>"+
  "    <td>"+
  "    <a class='btn deep-blue action edit' userid='"+obj.user_id+"'>Edit</a>"+
  "    <a class='btn red action delete' userid='"+obj.user_id+"'>Delete</a>"+
  "    </td>"+
  "</tr>";
  jQuery('#userList > tbody').append(line);
  eventQueue();
}

function clearFormModal(){
  jQuery('#form_user_id').val('');
  jQuery('#form_user_fullname').val('');
  jQuery('#form_user_email').val('');
  jQuery('#form_user_birth_date').val('');
  jQuery('#form_user_password').val('');
  jQuery('#form_user_profile').val('');
  jQuery("input#form_user_profile_1:radio").removeAttr('checked');
  jQuery("input#form_user_profile_2:radio").removeAttr('checked');
  jQuery("input#form_user_profile_3:radio").removeAttr('checked');
  jQuery("input[name='form_user_profile']"). prop("checked", false);
  jQuery('#formUserTitle').html('');
  jQuery('#submit_form').attr('actiontype','');
}

function userInputVals(){
  var form_user_id = jQuery('#form_user_id').val();
  var form_user_fullname = jQuery('#form_user_fullname').val();
  var form_user_email = jQuery('#form_user_email').val();
  var form_user_birth_date = jQuery('#form_user_birth_date').val();
  var form_user_password = jQuery('#form_user_password').val();
  var form_user_profile = jQuery("input[name='form_user_profile']:checked"). val();
  var user_data = '{'+
  '"user_id":"'+form_user_id+'",'+
  '"user_fullname":"'+form_user_fullname+'",'+
  '"user_email":"'+form_user_email+'",'+
  '"user_birth_date":"'+form_user_birth_date+'",'+
  '"user_password":"'+form_user_password+'",'+
  '"user_profile":"'+form_user_profile+'"'+
  '}';
  return JSON.parse(user_data);
}


function editUser(id){  
  jQuery.ajax({
    url: BASE_URL_API + 'users/'+ id,
    type: 'GET',
    success: function (data) {
      if (data.length <= 0) {
        clearFormModal();
        jQuery('#formUserModal').modal('close');
        M.toast({ html: 'Failed to get user!'});
      } else {
        var obj=data.data;
        jQuery('#formUserTitle').html('Edit user');
        jQuery('#submit_form').attr('actiontype','edit');
        jQuery('#form_user_id').val(obj.user_id);
        jQuery('#form_user_fullname').val(obj.user_fullname);
        jQuery('#form_user_email').val(obj.user_email);
        jQuery('#form_user_birth_date').val(obj.user_birth_date);
        jQuery('#form_user_password').val(obj.user_password);
        switch (obj.user_profile) {
          case 1:
            jQuery("input#form_user_profile_1:radio").trigger('click');
            break;
            
          case 2:
            jQuery("input#form_user_profile_2:radio").trigger('click');
            break;
        
          case 3:
          default:
            jQuery("input#form_user_profile_3:radio").trigger('click');
            break;
        }
      }      
    },
    error: function (ajaxContext) {console.log(ajaxContext)}
  })
  .done(function() {
    jQuery('#formUserModal').modal('open');
  })
  .fail(function (ajaxContext) {
    var errorData = JSON.parse(ajaxContext.responseText);
    M.toast({ html: 'Failed to get user!'});
  })
}

function deleteUser(id){
  jQuery.ajax({
    url: BASE_URL_API + 'users/'+ id,
    type: 'DELETE',
    success: function (data) {console.log(data)},
    error: function (ajaxContext) {console.log(ajaxContext)}
  })
  .done(function() {
    M.toast({ html: 'User deleted!'});
    jQuery('#trId_'+id).remove();
    jQuery('#formUserModal').modal('close');
    clearFormModal();
  })
  .fail(function (ajaxContext) {
    var errorData = JSON.parse(ajaxContext.responseText);
    M.toast({ html: 'Failed to delete!'});
  })
}

function updateUser(){
  var userid=jQuery('#form_user_id').val();
  var actiontype=jQuery('#submit_form').attr('actiontype');
  var obj = userInputVals();
  if(userid != "" && actiontype == 'edit'){
    jQuery.ajax({
      url: BASE_URL_API + 'users/' + userid,
      type: 'PUT',
      beforeSend: function (request) {
        // console.log(obj);
      },
      data: JSON.stringify({
        "user_id":obj.user_id,
        "user_fullname":obj.user_fullname,
        "user_email":obj.user_email,
        "user_birth_date":obj.user_birth_date,
        "user_password":obj.user_password,
        "user_profile":obj.user_profile
      }),
      dataType: "json",
      contentType: "application/json",
      success: function (data, textStatus, jQxhr) {
        M.toast({ html: 'Updated successfully!'});
      },
      error: function (ajaxContext) { console.log(ajaxContext);}
    })
      .done(function () {
        jQuery('#formUserModal').modal('close');
        clearFormModal();
      })
      .fail(function (ajaxContext) {
        var errorData = JSON.parse(ajaxContext.responseText);
        M.toast({ html: 'Failed to update!'});
      })
  }else{
    if(userid === "" && actiontype === 'add'){
      addUser();
    }
  }
}

function addUser(){
  var userid=jQuery('#form_user_id').val();
  var actiontype=jQuery('#submit_form').attr('actiontype');
  var obj = userInputVals();
  if(userid === "" && actiontype == 'add'){
    jQuery.ajax({
      url: BASE_URL_API + 'users',
      type: 'POST',
      beforeSend: function (request) {
        // console.log(obj);
      },
      data: JSON.stringify({
        "user_fullname":obj.user_fullname,
        "user_email":obj.user_email,
        "user_birth_date":obj.user_birth_date,
        "user_password":obj.user_password,
        "user_profile":obj.user_profile
      }),
      dataType: "json",
      contentType: "application/json",
      success: function (data, textStatus, jQxhr) {
        M.toast({ html: 'Created successfully!'});
        if(jQuery('#userList > tbody > tr').length < 10)
          addLine(data);
        jQuery('#formUserModal').modal('close');
      },
      error: function (ajaxContext) {
        var error=ajaxContext.responseJSON;
        if(error.status == 409){
          M.toast({ html: 'Failed to create!'});
          M.toast({ html: 'The email you entered is already in use'});
          jQuery('#form_user_email').focus();
        }
      }
    })
      .done(function () {
        jQuery('#formUserModal').modal('close');
        clearFormModal();
      })
      .fail(function (ajaxContext) {
        var errorData = JSON.parse(ajaxContext.responseText);
      })
  }
}


function eventQueue(){
  jQuery('#submit_form').on('click', function(event){
    event.preventDefault();
    updateUser();
  });

  jQuery('.action.add').on('click', function(){
    clearFormModal();
    jQuery('#formUserTitle').html('Add user');
    jQuery('#submit_form').attr('actiontype','add');
    jQuery('#formUserModal').modal('open');
    jQuery('#form_user_fullname').focus();
  });

  jQuery('.action.edit').on('click', function(){
    editUser(jQuery(this).attr('userid'));
  });

  jQuery('.action.delete').on('click', function(){
    var itemId = jQuery(this).attr('userid');
    if (! confirm('Delete?')) { 
      return false; 
    }else{
      deleteUser(itemId);
    }    
  });
}
//Regiter events
jQuery(document).ready(function () {
  eventQueue();
  
  jQuery('div.modal-footer .modal-close').on('click', function(){
    clearFormModal();
  });

  jQuery("#form_user_birth_date").mask('5678/34/12', {
  placeholder: "yyyy/mm/dd",
  'translation': {
    1: {pattern: /[0-3*]/},
    2: {pattern: /[0-9*]/},
    3: {pattern: /[0-1*]/},
    4: {pattern: /[0-9*]/},
    5: {pattern: /[1*]/},
    6: {pattern: /[9*]/},
    7: {pattern: /[0-9*]/},
    8: {pattern: /[0-9*]/},
        }
  });

});