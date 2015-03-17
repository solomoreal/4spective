$.fn.toggleClick = function() {
  var methods = arguments;    // Store the passed arguments for future reference
  var count = methods.length; // Cache the number of methods 

  // Use return this to maintain jQuery chainability
  // For each element you bind to
  return this.each(function(i, item){
      // Create a local counter for that element
      var index = 0;

      // Bind a click handler to that element
      $(item).on('click', function() {
          // That when called will apply the 'index'th method to that element
          // the index % count means that we constrain our iterator between 0
          // and (count-1)
          return methods[index++ % count].apply(this, arguments);
      });
  });
};