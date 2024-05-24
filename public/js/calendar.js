$(function () {

  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var date = $(this).parents('td').attr('date');
    var part = $(this).attr('part');

    // モーダルの予約日と時間を取得
    const reservationDate = date; // 予約日
    const reservationTime = part; // 時間

    // 予約日と時間の表示
    console.log("予約日：" + reservationDate);
    console.log("時間：" + reservationTime);

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
