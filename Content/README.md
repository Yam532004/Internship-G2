# Internship-G2
# 17-6
I. HTML
    1. Thẻ
        - Thẻ p chứa đoạn văn bản 
        - Thẻ a chứa link liên kết
        - Thẻ img dùng để chèn ảnh vào trang web
        - Thẻ b để bolder văn bản 
        - Thẻ i tạo nét nghiêng cho văn bản 
        - Thẻ có các loại: 
            * Thẻ kép: như thẻ p
            * Thẻ đơn: như thẻ img, a
            * Thẻ lồng nhau: trong thẻ p có thẻ b hoặc i 
    2. Cấu trúc
        - Bắt đầu bằng thẻ <html>, kết thúc bằng thẻ </html>
        - Trong html chia thành hai phần: header và body 
    3. Div và span:
        - Div là một phần tử khối, dùng làm thùng chứa cho các phần tử khác
        - Span là phần tử nối tuyến, làm thùng chứa cho các phần tử nội tuyến khác
    4. Các position trong css 
        - Static: là position mặc định, các thành phần sẽ nằm theo thứ tự của văn bản
        - Fixed: Vị trí tuyệt đối, không thay đổi kể cả scrolling
        -  
# 18-6
I. JQUERY
    - CT: $(selector).action()
    ví dụ: chọn class footer và ẩn nó đi
    $(."footer").hiden();
1. Call back:
    - Code mình sẽ chạy từ trên xuống dưới
    - Nhưng đặt trong trường hợp là hàm jquery chạy chưa xong, nó cần 5-10s, mà trong khi đó
    các lệnh khác vẫn chạy và không chờ jquery chạy xong đã. Từ đó dẫn đến chương trình chạy sai 
    - Để ngăn chặn việc này thì sẽ sinh ra một cái là call back
    - Nghĩa là sau khi Jquery chạy xong thì nó sẽ gọi hàm call back để lấy giá trị của jquery nhét vào lại chổ cần nó
2. SlideToggle()
    - Dùng để hiện hoặc ẩn selector
    - Nó sẽ kiểu luân phiên nhau 
3. Animate ()
    - Dùng để tạo hiệu ứng động (di chuyển, thay đổi kích thước..) cho phần HTML 