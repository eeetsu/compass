$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  //プロフィール詳細画面の「選択科目の編集」のアコーディオン（開閉ボタンの設置）
  // タイトルをクリックすると
  $(".js-accordion-title").on("click", function () {
    // クリックした次の要素を開閉
    $('.accordion-content').slideToggle();
    // タイトルにopenクラスを付け外しして矢印の向きを変更
    $(this).toggleClass("open", 300);
  });


  //プロフィール詳細画面の「選択科目の編集」のアコーディオン（開閉ボタンの設置）
  // タイトルをクリックすると
  $(".js-accordion-title-search").on("click", function () {
    // クリックした次の要素を開閉
    $('.accordion-content').slideToggle();
    // タイトルにopenクラスを付け外しして矢印の向きを変更
    $(this).toggleClass("open", 300);
  });

});
