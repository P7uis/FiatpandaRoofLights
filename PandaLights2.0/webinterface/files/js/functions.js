function appendText(profile) {
  var lastrow = parseInt($('#max' + profile).val())
  var newrow = lastrow + 1;
  if (lastrow == 0 || rowchecker(profile)) {
    $('#max' + profile).val(newrow);
    var checkboxrow = '<div id="checkboxrow' + newrow + '" class="input-group mb-1"><div class="input-group-prepend"><div class="input-group-text alt-input-style"><input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '0" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '1" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '2" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '3" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '4" class="profilecheck">&ensp;</div></div><input type="number" name="' + profile + '" required min="0.1" max="60" step="0.1" name="delay' + newrow + '" value="1" class="form-control  input-style" placeholder="delay"></div>';
    $("#checkboxrows" + profile).append(checkboxrow); // Append new elements
  }
}

function rowchecker(profile) {
  while (true) {
    var lastrow = parseInt($('#max' + profile).val())
    var secondlastrow = lastrow - 1;
    var lastcheck = false;
    for (var i = 0; i < 5; i++) {
      if ($('[name="profile' + profile + parseInt(lastrow) + i + '"]').is(':checked')) {
        lastcheck = true;
        break;
      }
    }

    var secondlastcheck = false;
    for (var i = 0; i < 5; i++) {
      if ($('[name="profile' + profile + secondlastrow + i + '"]').is(':checked')) {
        secondlastcheck = true;
        break;
      }
    }
    if (secondlastcheck) {
      if (lastcheck) {
        return true;
      } else {
        //do nothing
        return false;
      }
    } else {
      if (lastrow == 0) return false;
      else {
        $('#max' + profile).val(parseInt(lastrow) - 1);
        $("#checkboxrow" + lastrow).remove();
      }
    }
  }
}

function DelayChanger(profile) {
  var lastrow = parseInt($('#max' + profile).val())
  delay = $('#alldelay' + profile).val();
  console.log(delay);
  $('.delay' + profile).val(delay);
}
