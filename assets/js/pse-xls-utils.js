window.pse_utils = {};

// Main vlookup function
window.pse_utils._vmain = function(action, search_key, range, index, is_sorted) {
  var iterator = 0;
  for (iterator = 0; range.length > iterator; iterator++) {
    if (search_key == range[iterator][0]) {
      if (action == 'vlookup') {
        return range[iterator][index - 1];
      } else if (action == 'vindex') {
        return iterator;
      }
    }
  }
}

window.pse_utils._round = function(value, decimals) {
  return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

// vlookup Function
window.pse_utils._vlookup = function(search_key, range, index, is_sorted) {
  return window.pse_utils._vmain('vlookup', search_key, range, index, is_sorted);
}

window.pse_utils._commas = function(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// If Statement
window.pse_utils._if = function(logical_expression, value_if_true, value_if_false) {
  if (logical_expression) {
    return value_if_true;
  }
  return value_if_false;
}

// Get Max
window.pse_utils._max = function(range) {
  return range.reduce(function(a, b) {
    return Math.max(a, b);
  });
}

// Get SUM
window.pse_utils._sum = function(input) {
  // w3resource.com
  if (toString.call(input) !== "[object Array]")
    return false;

  var total = 0;
  for (var i = 0; i < input.length; i++) {
    if (isNaN(input[i])) {
      continue;
    }
    total += Number(input[i]);
  }
  return total;
}

// Get _vlookup index
window.pse_utils._vindex = function(search_key, range) {
  return window.pse_utils._vmain('vindex', search_key, range, 0, false);
}

// roundup Function
window.pse_utils._roundup = function(num, precision) {
  precision = Math.pow(10, precision)
  return Math.ceil(num * precision) / precision
}

// rounddown Function
window.pse_utils._rounddown = function(number, decimals) {
  decimals = decimals || 0;
  return (Math.floor(number * Math.pow(10, decimals)) / Math.pow(10, decimals));
}

// Internal Methods

window.pse_utils.setText = function(class_name, text) {
  return this.find(class_name).text(text);
};
