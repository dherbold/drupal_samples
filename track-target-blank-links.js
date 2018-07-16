/**
* Track clicks to a link. If new_window is true the google analytics request
* will be made synchronously, because browsers block new windows from opening unless
* it is done DURING an on click event. If new_window is false, the request will
* be made asynchronously, and the current window url will be changed.
*/
var trackOutboundLink = function(url, new_window) {
  ga('send', 'event', 'outbound', 'click', url, {'hitCallback':
    function () {
      if (!new_window) {
        document.location = url;
      }
    }
  });
  if (new_window){
    window.open(url);
  }
}

/**
* Add an onclick event to all links with class name "track", which will trigger
* the above defined trackOutboundLink function
*/
$(document).ready(function(){
  // set google analytics onclick link event on each link with class track
  $('a.track').each(function(index, element){
    element = $(element);
    var link = element.attr('href');
    var new_window = element.attr('target') == '_blank' ? true : false;
    element.click(function(){
      trackOutboundLink(link, new_window);
      return false;
    });
  });
});
