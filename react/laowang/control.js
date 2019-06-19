(function() {
  var count = 3000;

  function loopCount() {
    document.getElementById('number').innerHTML = count;
    count += 1;

    setTimeout(loopCount, 1000);
  }

  document.addEventListener('DOMContentLoaded', loopCount, false);
})();
