// Chọn một class trong trang và ẩn nó đi
// $(".footer").hide();
$(".btnSearch").click(function () {
  $(".Search").slideToggle();
//   toggleClass để di thay đổi hiện hay mất thuộc tính đó trong class 
  $("nav,.footer,.offcanvas-body").toggleClass("bg-sidebar");
  $(".Search,.nav-link,.footer").toggleClass("text-white");
});

