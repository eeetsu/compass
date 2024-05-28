$(function () {
  // ボタン(class="edit-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {
    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
    // 押されたボタンから投稿内容を取得し変数へ格納
    var value = $(this).attr('value'); //setting_reserve
    var reservepart = $(this).attr('reservepart');  //setting_part

    //表示用
    $('.modal-date').text(value);
    $('.modal-part').text(reservepart);
    //データを送るため用
    $('.modal-date-input').val(date);
    $('.modal-date-input').val(part);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
