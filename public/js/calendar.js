$(function () {

  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var date = $(this).attr('date'); //setting_reserve
    var part = $(this).attr('part');  //setting_part

    $('.modal-date').text(date);
    $('.modal-part').text(part);
    $('.modal-date-input').val(date);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
