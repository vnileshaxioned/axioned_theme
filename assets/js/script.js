$(document).ready(function () {
  // Info Session code starts

  var tz = jstz.determine(); // the time zone of the client's browser
  var mytimezone = tz.name(); // Returns the name of the time zone

  // Add time zone to form
  var tzList = pa_infosession_data.timezone_list;
  $.each(tzList, function (i) {
    $('#session-timezone').append(
      $('<option/>', {
        value: tzList[i].timezone,
        text: tzList[i].timezone_label,
        selected: mytimezone == tzList[i].timezone ? true : false,
      })
    );
  });

  sessionData();

  $('#session-timezone').change(sessionData);

  function sessionData() {
    $.ajax({
      url: ajax.ajaxurl,
      type: 'POST',
      data: {
        action: 'infosession_data',
      },
      success: function (response) {
        let data = JSON.parse(response);
        let selectedTimeZone = $('#session-timezone').find(':selected').val();
        selectedTimeZone = selectedTimeZone ? selectedTimeZone : mytimezone;
        var timeFormatted = [];
        $.each(data, function (key, value) {
          var timeValue = setSessionTime(value, selectedTimeZone);
          timeFormatted.push(value.name + ': ' + timeValue.stringTime);
        });

        if (timeFormatted) {
          $('.info-session').html('');
          for (var i = 0; i < timeFormatted.length; i++) {
            $('.info-session').append(
              `<option value="${timeFormatted[i]}">${timeFormatted[i]}</option>`
            );
          }
        }
      },
    });
  }

  function setSessionTime(props, timeZone) {
    var utc_date = new Date(
      Date.UTC(
        props.year,
        props.month - 1,
        props.day,
        props.hours,
        props.minutes
      )
    );
    var resultDate = new Date(
      utc_date.toLocaleString('en-US', { timeZone: timeZone })
    );
    var dayName = resultDate.toLocaleDateString('en-US', { weekday: 'long' });
    var monthName = resultDate.toLocaleString('default', { month: 'long' });
    var time = resultDate.toLocaleString('en-US', {
      hour: 'numeric',
      minute: 'numeric',
      hour12: true,
    });
    return {
      stringTime: `${dayName}, ${monthName} ${dateOrd(
        resultDate.getDate()
      )}, ${time.toLowerCase()}`,
    };
  }

  function dateOrd(date) {
    var ords = [, 'st', 'nd', 'rd'];
    return date + (date > 10 && date < 14 ? 'th' : ords[date % 10] || 'th');
  }

  // Info Session code ends

  // todo page started here
  if (localStorage.getItem('task')) {
    var task = JSON.parse(localStorage.getItem('task'));
    for (var i = 0; i < task.length; i++) {
      appendTask(task[i]);
    }
  } else {
    var task = [];
  }

  // for save todo task
  $('.submit-button').click(function (e) {
    e.preventDefault();
    var taskValue = $('.form-content').val();
    var taskIndex = $('.task-index').val();

    if (taskIndex && taskValue) {
      task[taskIndex] = taskValue;
      localStorage.setItem('task', JSON.stringify(task));
      appendTask(taskValue, taskIndex);
    } else {
      task.push(taskValue);
      localStorage.setItem('task', JSON.stringify(task));
      appendTask(taskValue);
    }
  });

  function appendTask(taskName, taskIndex = '') {
    var taskList = `<p class="task-name">${taskName}</p>`;
    taskList += `<div class="action-button">`;
    taskList += `<a href="#FIXME" class="edit-task" title="Edit">Edit</a>`;
    taskList += `<a href="#FIXME" class="delete-task" title="Delete">Delete</a>`;
    taskList += `</div>`;

    if (taskIndex && taskName) {
      index = parseInt(taskIndex) + 1;
      $('.todo-list:nth-child(' + index + ')').html(taskList);
    } else {
      var liElement = $('<li>').addClass('todo-list');
      liElement.html(taskList);
      $('.todo-task').append(liElement);
    }
  }

  // for delete todo task
  $('.delete-task').click(function (e) {
    e.preventDefault();
    var clickedElement = $('.delete-task').index(this);
    task.splice(clickedElement, 1);
    localStorage.setItem('task', JSON.stringify(task));
    $(this).parents('.todo-list').remove();
  });

  // for update todo task
  $('.edit-task').click(function (e) {
    e.preventDefault();
    var clickedElement = $('.edit-task').index(this);
    var editInput = `<input type="hidden" class="task-index" value="${clickedElement}" />`;
    editInput += ` <input type="text" name="task" class="form-content" value="${task[clickedElement]}" />`;

    $('.form-content').parent().html(editInput);
  });
  // todo page ended here

  // for tab filter and search function for a work page
  searchFilter();

  // for tab filter
  $('.work-tag').click(function (e) {
    e.preventDefault();
    var data = $(this);
    var tagSlug = data.attr('data-slug') == 'all' ? '' : data.attr('data-slug');

    // remove all tag active class
    $('.work-tag').parent().children('.work-tag').removeClass('tag-active');

    // add tag active class
    searchFilter(tagSlug, '');
    data.addClass('tag-active');
  });

  // for search
  $('.form-content').keyup(function () {
    var data = this;
    searchFilter('', data.value);
  });

  // searchFilter function to call ajax request
  function searchFilter(tag, search) {
    var postPerPage = $('.form-content').attr('data-post');
    $.ajax({
      type: 'post',
      url: ajax.ajaxurl,
      data: {
        action: 'filter_search',
        tag_name: tag,
        search: search,
        post_per_page: postPerPage,
      },
      datatype: 'json',
      success: function (response) {
        if (response.length) {
          $('.our-work').html(response);
        } else {
          $('.our-work').html('<li><span>No Search found</span></li>');
        }
      },
      error: function (xhr, status, error) {
        alert('Status: ' + xhr.status + ' ' + error);
      },
    });
  }
});