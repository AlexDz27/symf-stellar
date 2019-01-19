$('.article__like-icon').on('click', function (evt) {
  evt.preventDefault();

  var $link = $(evt.currentTarget);
  $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

  $.ajax({
    method: 'POST',
    url: $link.attr('href'),
    success: function (response) {
      $('.article__like-count').html(response.likes);
    }
  })
});