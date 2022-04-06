<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category: (1) Sách.
        DB::table('products')->insert([
            'name' => 'Cây Cam Ngọt Của Tôi',
            'description' => '
            JOSÉ MAURO DE VASCONCELOS (1920-1984) là nhà văn người Brazil. Sinh ra trong một gia đình nghèo ở ngoại ô Rio de Janeiro, lớn lên ông phải làm đủ nghề để kiếm sống. Nhưng với tài kể chuyện thiên bẩm, trí nhớ phi thường, trí tưởng tượng tuyệt vời cùng vốn sống phong phú, José cảm thấy trong mình thôi thúc phải trở thành nhà văn nên đã bắt đầu sáng tác năm 22 tuổi. Tác phẩm nổi tiếng nhất của ông là tiểu thuyết mang màu sắc tự truyện Cây cam ngọt của tôi. Cuốn sách được đưa vào chương trình tiểu học của Brazil, được bán bản quyền cho hai mươi quốc gia và chuyển thể thành phim điện ảnh. Ngoài ra, José còn rất thành công trong vai trò diễn viên điện ảnh và biên kịch.
            ',
            'image' => '/images/products/cay-cam-ngot-cua-toi.jpg',
            'price' => 75600,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'How Psychology Works - Hiểu Hết Về Tâm Lý Học',
            'description' => '
            MỘT TRONG NHỮNG CUỐN SÁCH MỞ KHÓA HỮU ÍCH NHẤT VỀ TƯ DUY, KÝ ỨC VÀ CẢM XÚC CỦA CON NGƯỜI!
            Ám sợ là gì, ám sợ có thực sự đáng sợ không? Rối loạn tâm lý là gì, làm thế nào để thoát khỏi tình trạng suy nhược và xáo trộn đó? Trầm cảm là gì, vì sao con người hiện đại thường xuyên gặp và chống chọi với tình trạng u uất, mệt mỏi và tuyệt vọng này?
            ',
            'image' => '/images/products/how-psychology-works-hieu-het-ve-tam-ly-hoc.jpg',
            'price' => 269350,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Luật Tâm Thức - Giải Mã Ma Trận Vũ Trụ',
            'description' => '
            Dịch bệnh, thiên tai, chiến tranh… có phải là lời cảnh cáo của tự nhiên đến con người?
            “Biến đổi khí hậu” là một nước đi chính trị hay chỉ là sự thay đổi của Trái Đất theo chu kỳ?
            UFO, người ngoài hành tinh có thật không?
            Tại sao Kinh dịch lại tiên đoán được các sự kiện?
            Mỗi con người có số mệnh định sẵn không? Chúng ta sẽ đi về đâu sau khi chết?
            ',
            'image' => '/images/products/luat-tam-thuc-giai-ma-ma-tran-vu-tru.jpg',
            'price' => 216200,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Giải thích Ngữ pháp tiếng Anh (Tái Bản)',
            'description' => '
            Ngữ pháp Tiếng Anh tổng hợp các chủ điểm ngữ pháp trọng yếu mà học sinh cần nắm vững. Các chủ điểm ngữ pháp được trình bày rõ ràng, chi tiết. Sau mỗi chủ điểm ngữ pháp là phần bài tập & đáp án nhằm giúp các em củng cố kiến thức đã học, đồng thời tự kiểm tra kết quả.
            Sách Giải Thích Ngữ Pháp Tiếng Anh, tác Mai Lan Hương - Hà Thanh Uyên, là cuốn sách ngữ pháp đã được phát hành và tái bản rất nhiều lần trong những năm qua.
            ',
            'image' => '/images/products/giai-thich-ngu-phap-tieng-anh-tai-ban.jpg',
            'price' => 126000,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Đừng Làm Việc Chăm Chỉ Hãy Làm Việc Thông Minh',
            'description' => '
            Thành công là học cách làm việc THÔNG MINH hơn chứ không phải CHĂM CHỈ hơn! Những người thành công thường chỉ tập trung thời gian của họ vào một vài ưu tiên và luôn nghĩ làm thế nào để mọi việc diễn ra suôn sẻ.
            Mỗi người đều có 96 khối năng lượng mỗi ngày để làm những gì chúng ta muốn. Bạn luôn cần đảm bảo mình đang sử dụng mỗi khối năng lượng một cách khôn ngoan để đạt được tiến bộ nhanh nhất trên các mục tiêu quan trọng của bản thân. Đừng Làm Việc Chăm Chỉ Hãy Làm Việc Thông Minh để luôn duy trì nguồn năng lượng tích cực là cuốn sách Bizbooks xin trân trọng gửi đến quý độc giả
            ',
            'image' => '/images/products/dung-lam-viec-cham-chi-hay-lam-viec-thong-minh.jpg',
            'price' => 107250,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Rèn Luyện Tư Duy Phản Biện',
            'description' => '
            Như bạn có thể thấy, chìa khóa để trở thành một người có tư duy phản biện tốt chính là sự tự nhận thức. Bạn cần phải đánh giá trung thực những điều trước đây bạn nghĩ là đúng, cũng như quá trình suy nghĩ đã dẫn bạn tới những kết luận đó. Nếu bạn không có những lý lẽ hợp lý, hoặc nếu suy nghĩ của bạn bị ảnh hưởng bởi những kinh nghiệm và cảm xúc, thì lúc đó hãy cân nhắc sử dụng tư duy phản biện! Bạn cần phải nhận ra được rằng con người, kể từ khi sinh ra, rất giỏi việc đưa ra những lý do lý giải cho những suy nghĩ khiếm khuyết của mình. Nếu bạn đang có những kết luận sai lệch này thì có một sự thật là những đức tin của bạn thường mâu thuẫn với nhau và đó thường là kết quả của thiên kiến xác nhận, nhưng nếu bạn biết điều này, thì bạn đã tiến gần hơn tới sự thật rồi!
            ',
            'image' => '/images/products/ren-luyen-tu-duy-phan-bien.jpg',
            'price' => 60400,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Nóng Giận Là Bản Năng , Tĩnh Lặng Là Bản Lĩnh',
            'description' => '
            Sai lầm lớn nhất của chúng ta là đem những tật xấu, những cảm xúc tiêu cực trút bỏ lên những người xung quanh, càng là người thân càng dễ gây thương tổn.
            Cái gì cũng nói toạc ra, cái gì cũng bộc lộ hết không phải là thẳng tính, mà là thiếu bản lĩnh. Suy cho cùng, tất cả những cảm xúc tiêu cực của con người đều là sự phẫn nộ dành cho bất lực của bản thân. Nếu bạn đúng, bạn không cần phải nổi giận. Nếu bạn sai, bạn không có tư cách nổi giận.
            ',
            'image' => '/images/products/nong-gian-la-ban-nang-tinh-lang-la-ban-linh.jpg',
            'price' => 57850,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Sapiens Lược Sử Loài Người (Tái Bản)',
            'description' => '
            Sapiens là một câu chuyện lịch sử lớn về nền văn minh nhân loại – cách chúng ta phát triển từ xã hội săn bắt hái lượm thuở sơ khai đến cách chúng ta tổ chức xã hội và nền kinh tế ngày nay.
            Trong ấn bản mới này của cuốn Sapiens - Lược sử loài người, chúng tôi đã có một số hiệu chỉnh về nội dung với sự tham gia, đóng góp của các thành viên Cộng đồng đọc sách Tinh hoa. Xin trân trọng cảm ơn ý kiến đóng góp tận tâm của các quý độc giả, đặc biệt là ông Nguyễn Hoàng Giang, ông Nguyễn Việt Long, ông Đặng Trọng Hiếu cùng những người khác. Mong tiếp tục nhận được sự quan tâm và góp ý từ độc giả.
            ',
            'image' => '/images/products/sapiens-luoc-su-loai-nguoi-tai-ban.jpg',
            'price' => 237000,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Tâm Lý Học - Nghệ Thuật Giải Mã Hành Vi',
            'description' => '
            "Với sự phát triển nhanh chóng như hiện nay, có những người vì theo đuổi lợi ích, thỏa mãn dục vọng của chính mình mà thường lừa gạt đấu đá lẫn nhau. Muốn có chỗ đứng trong xã hội này nếu không biết cách nhìn lòng người, tất nhiên sẽ bị lừa gạt hãm hại hoặc phản bội, bị người khác giẫm đạp xuống tầng thấp nhất."
            ',
            'image' => '/images/products/tam-ly-hoc-nghe-thuat-giai-ma-hanh-vi.jpg',
            'price' => 103500,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Nhà Giả Kim (Tái Bản 2020)',
            'description' => '
            Tất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người.
            Tiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.
            ',
            'image' => '/images/products/nha-gia-kim-tai-ban-2020.jpg',
            'price' => 79000,
            'category' => 1,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);


        // Category: (2) Rau củ quả.
        DB::table('products')->insert([
            'name' => 'Rau Muống Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà Lạt
            Rau giòn và ngọt tự nhiên.
            Cung cấp nhiều vitamin, chất xơ, khoáng chất tốt cho người mới ốm dậy, kén ăn, phụ nữ có thai và bị táo bón.
            Thường được dùng để làm các món luộc, xào, nấu canh hoặc ăn lẩu.
            ',
            'image' => '/images/products/rau-muong-da-lat-tro-gia-tan-vuon.png',
            'price' => 19000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Cà Rốt Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà Lạt
            Vị ngọt, giòn, giàu vitamin A và khoáng chất.
            Tốt cho mắt, phòng ngừa ung thư và một số bệnh khác.
            Có tác dụng làm đẹp.
            Dễ dàng chế biến thành nhiều món ăn khác nhau.
            ',
            'image' => '/images/products/ca-rot-da-lat-tro-gia-tan-vuon.png',
            'price' => 27000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Mướp Hương Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà Lạt
            Mướp chứa nhiều nước, protid, chất xơ, canxi, photpho, sắt, beta-caroten, B1, B6, B2, C…
            Có tác dụng sáng mắt, hỗ trợ sức khỏe tim mạch, giải nhiệt, ngăn ngừa tiểu đường
            Có thể dùng để nấu canh cùng với rau ngót, mồng tơi, hến,...
            ',
            'image' => '/images/products/muop-huong-da-lat-tro-gia-tan-vuon-1kg.png',
            'price' => 14000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Hành Lá Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà Lạt
            Vị hăng, có hai phần là lá và củ
            Giải cảm, diệt khuẩn
            Thích hợp gia vị
            ',
            'image' => '/images/products/hanh-la-da-lat-tro-gia-tan-vuon-1kg.png',
            'price' => 25000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Đậu Bắp Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà Lạt
            Đậu bắp có màu xanh, bề mặt phủ lông mịn, ruột có hạt và nhớt.
            Chất dinh dưỡng trong bầu có tác dụng chống oxy hóa, chắc xương, giảm lượng đường trong máu, nhuận tràng.
            Có thể dùng để luộc, nấu canh chua, làm nước ép.
            ',
            'image' => '/images/products/dau-bap-da-lat-tro-gia-tan-vuon-1kg.png',
            'price' => 29000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Su Hào Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà Lạt, Việt Nam
            Su hào có vị ngọt, giòn và thanh mát.
            Chứa nhiều vitamin A, C, Kali, Calcium, Magiê, chất khoáng và chất xơ.
            Có thể chế biến thành nhiều món như luộc, xào, nấu canh, sú
            ',
            'image' => '/images/products/su-hao-da-lat-tro-gia-tan-vuon-1kg.png',
            'price' => 26000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Rau Dền, túi 300gr',
            'description' => '
            Rau lấy tận vườn Hoocmon, hái mỗi buổi sáng.
            Được nuôi trồng và đóng gói cẩn thẩn, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng.
            Đặc điểm: Thân thảo, màu xanh, hoặc tím, vỏ nhẵn, không có lông; lá xanh tím xen lẫn, mềm và dễ dập lá, khi ăn rất mềm
            Hỗ trợ điều trị chứng táo bón, chắc khỏe xương, tốt đường hô hấp, là thực phẩm bổ sung dinh dưỡng cho các bà mẹ sau sinh.
            Có thể dùng rau dưới dạng luộc, nấu canh cùng các loại tôm, thịt.
            ',
            'image' => '/images/products/rau-den-tui-300gr.jpg',
            'price' => 12000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Cần Tây Đà Lạt Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Xuất xứ: Đà lạt
            Cần tây có vị ngọt và giòn tự nhiên, ít hăng.
            Chứa nhiều vitamin A, B, C, magie, mangan, sắt, kali,
            tốt cho việc ép nước uống giảm cân.
            thanh nhiệt, giảm ho, lợi tiểu, trị sỏi nhỏ viêm đường tiết niệu,
            giúp loại bỏ tác nhân gây ra ung thư.
            tăng cường khả năng hoạt động của bạch cầu, chống oxy hóa.
            ',
            'image' => '/images/products/can-tay-da-lat-tro-gia-tan-vuon.png',
            'price' => 44000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Súp Lơ Xanh Trợ Giá Tận Vườn (1Kg)',
            'description' => '
            Súp lơ xanh : là một trong các loại thực phẩm giàu vitamin và ion khoáng nhất, được chứng minh có nhiều lợi ích cho sức khỏe.
            ',
            'image' => '/images/products/sup-lo-xanh-tro-gia-tan-vuon-1kg.png',
            'price' => 45000,
            'category' => 2,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        // Category: (3) Cây cảnh.
        DB::table('products')->insert([
            'name' => 'GIỐNG CÂY CHERRY BRAZIL',
            'description' => '
            Cherry Brazil còn được gọi là Anh đào Brazil, anh đào Nam mỹ,
            Cây giống Cherry Brazil là giống chery chịu nhiệt mới được trồng ở nước ta. Trái có đặc điểm thơm-mọng-ngọt. Có thể trồng ở vườn hoặc trồng chậu đều được. Cây giống chuẩn nhập khẩu trực tiếp, trồng sau 12 tháng cho quả.
            ',
            'image' => '/images/products/giong-cay-cherry-brazil.jpg',
            'price' => 45000,
            'category' => 3,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Sen Đá Ruby Đỏ - 7x7x15 Cm - Cây Mini Để Bàn & Chậu Gốm Sứ Bát Tràng Trồng Cây Sen Đá, Xương Rồng, Tiểu cảnh Terrarium - Dáng Trôn Ốc',
            'description' => '
            Kết hợp độc đáo giữa Sen đá & chậu sứ Bát Tràng!
            ',
            'image' => '/images/products/sen-da-ruby-do-7x7x15-cm.jpg',
            'price' => 9000,
            'category' => 3,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Cây Kim Phát Tài mini để bàn (cây Kim Tiền) (Cây, chậu gốm & đĩa lót)',
            'description' => '
            Cây, chậu gốm & đĩa lót
            ',
            'image' => '/images/products/cay-kim-phat-tai-mini-de-ban-cay-kim-tien-cay-chau-gom-dia-lot.jpg',
            'price' => 149000,
            'category' => 3,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);


        // Category: (4) Máy tính, laptop.
        DB::table('products')->insert([
            'name' => 'Laptop HP Pavilion 15-eg0542TU 4P5G9PA (Core i3-1125G4/ 4GB/ 256GB/ 15.6 FHD/ Win11) - Hàng Chính Hãng',
            'description' => '
            Thiết kế hiện đại, sang trọng:
            Laptop HP Pavilion 15-eg0542TU 4P5G9PA với thiết kế nắp lưng và chiếu nghỉ tay được làm bằng kim loại, phủ một lớp gam màu bạc sang trọng, tạo cảm giác mát tay khi sờ vào và cho khả năng tản nhiệt tốt. Bạn có thể dễ dàng cất gọn chiếc laptop này vào cặp xách, balo mang theo bên mình bởi trọng lượng của nó chỉ 1.682 kg và dày 17.9 mm.
            ',
            'image' => '/images/products/laptop-hp-pavilion-15-eg0542tu-4p5g9pa.jpg',
            'price' => 14929000,
            'category' => 4,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Laptop Acer Swift 3 Evo SF314-511-59LV (Core i5-1135G7/ 16GB/ 512GB SSD M.2 PCIE Gen3x4/ 14 FHD IPS/ Win10) - Hàng Chính Hãng',
            'description' => '
            Màn hình trực quan:
            Laptop Acer Swift 3 Evo SF314-511-59LV cho bạn đắm mình trong giải trí mà bạn đã chọn với viền siêu hẹp 5,1 mm cho tỷ lệ màn hình trên thân máy lên đến 85,73%. Với tuỳ chọn tối đa 300 nits và 100% sRGB, màn hình 14 inch FHD IPS không chói với tính năng làm mờ DC tạo ra hình ảnh phong phú, sáng sủa và ổn định nhất quán.
            ',
            'image' => '/images/products/laptop-acer-swift-3-evo-sf314-511-59lv.jpg',
            'price' => 23990000,
            'category' => 4,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Máy tính xách tay Laptop Dell Latitude 3420 L3420I3SSD (Intel Core i3-1115G4 | 14 Inch HD | RAM 8GB | 256GB SSD NVMe | Intel UHD Graphics | Fedora Os) - Hàng chính hãng',
            'description' => '
            Thiết kế sang trọng:
            Laptop Dell Latitude 3420 L3420I3SSD được thiết kế đơn giản, sang trọng với  vỏ ngoài được phủ sơn màu đen và các cạnh bên được vát mỏng, các đường nét góc cạnh được bo tròn gọn gàng, mặt lưng trơn in nổi logo Dell. Ngoài tính thẩm mĩ, Dell cũng đảm bảo độ bền bỉ, chắc chắn và tính di động để có thể đồng hành với bạn trong mọi hành trình lâu dài. Khung máy chắc chắn, bền bỉ giúp bảo vệ linh kiện tối đa trước tác động bên ngoài.
            ',
            'image' => '/images/products/may-tinh-xach-tay-laptop-dell-latitude-3420-l3420i3ssd.jpg',
            'price' => 16400000,
            'category' => 4,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Laptop ASUS VivoBook A515EA-L11171T (Core i5-1135G/ 8GB (8GBx1) DDR4/ 8GB (8GBx1) DDR4/ 15.6 FHD OLED/ Win10) - Hàng Chính Hãng',
            'description' => '
            Làm việc năng suất, phong cách thời thượng:
            Laptop ASUS VivoBook A515EA-L11171T với màu sắc nổi bật và phím Enter viền vàng neon độc đáo, mang đến sự tinh tế và năng động cho chiếc máy tính sử dụng hàng ngày. Với bộ vi xử lý Intel Core i5 thế hệ 11 Tiger Lake, VivoBook A515EA-L11171T mang tới sức mạnh bạn cần để hoàn thành mọi nhiệm vụ. Ngoài ra, với tính năng cảm biến vân tay sẽ giúp bạn đăng nhập máy một cách dễ dàng và tăng tính an toàn cho máy tính của bạn.
            ',
            'image' => '/images/products/laptop-asus-vivobook-a515ea-l11171t.jpg',
            'price' => 19579000,
            'category' => 4,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Laptop HP Pavilion 15-eg0539TU 4P5G6PA (Core i5-1135G7/ 8GB DDR4 3200MHz/ 512GB PCIe NVMe M.2 SSD/ 15.6 FHD IPS/ Win10) - Hàng Chính Hãng',
            'description' => '
            CPU: Intel Core i5-1135G7 (upto 4.20GHz, 8MB)
            RAM: 8GB(2 x 4GB) DDR4 3200MHz (2 Khe)
            Ổ cứng: 512GB PCIe NVMe M.2 SSD
            VGA: Intel Iris Xe Graphics
            Màn hình: 15.6 inch FHD (1920 x 1080), IPS, micro-edge, BrightView, 250 nits, 45% NTSC
            Pin: 3-cell, 41 Wh
            Cân nặng: 1.75 kg
            Màu sắc: Bạc
            OS: Windows 10 Home
            ',
            'image' => '/images/products/laptop-hp-pavilion-15-eg0539tu-4p5g6pa.jpg',
            'price' => 19990000,
            'category' => 4,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);


        // Category: (5) Điện thoại.
        DB::table('products')->insert([
            'name' => 'Điện thoại Vivo Y12s - Hàng Chính Hãng',
            'description' => '
            Thiết kế thời thượng với mặt lưng chuyển đổi màu độc đáo:
            Điện thoại Vivo Y12s được thiết kế theo phong cách hiện đại, nguyên khối, mặt lưng của máy được bo cong 2.5D, sắc màu gradient thời thượng, kết hợp với thân máy mỏng nhẹ tạo cảm giác thoải mái và cao cấp khi cầm trên tay.
            Trọng lượng máy nhẹ (chỉ khoảng 191 g) cùng với đó là khả năng chống bám mồ hôi và dấu vân tay tốt.
            Máy được thiết kế với cảm biến vân tay tích hợp nút nguồn đặt ở cạnh bên, tối ưu hóa cho thao tác mở khóa với tốc độ chỉ 0.22 giây.
            Bên cạnh đó, Vivo Y12s cũng được trang bị nhận diện khuôn mặt mang đến cho người dùng một tùy chọn khác để mở khóa điện thoại trong tích tắc.
            ',
            'image' => '/images/products/dien-thoai-vivo-y12s-hang-chinh-hang.jpg',
            'price' => 3790000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);
        
        DB::table('products')->insert([
            'name' => 'Điện Thoại Samsung Galaxy Z Fold 3 (256GB) - Hàng Chính Hãng',
            'description' => '
            Sẵn sàng mở ra tiềm năng công nghệ mới:
            Không dừng lại ở một chiếc điện thoại thông minh cao cấp, mà nó còn bền bỉ và kết nối siêu tốc với 5G. Kế đến là màn hình tràn viền lớn với trải nghiệm gập mở độc nhất để bạn có thể giải trí và làm việc ở một cách hoàn hảo.
            ',
            'image' => '/images/products/dien-thoai-samsung-galaxy-z-fold-3-256gb-hang-chinh-hang.jpg',
            'price' => 37990000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại iPhone 12 Pro Max 256GB - Hàng Chính Hãng',
            'description' => '
            iPhone 12 Pro Max 256GB - Nâng tầm đẳng cấp sử dụng:
            Ngày 14/10 vừa qua, Apple đã trình làng iPhone 12 với các phiên bản làm điên đảo các tín đồ của nhà Táo. Apple năm nay lại ra thêm một chiếc iPhone mới với tên gọi mới là iPhone 12 Pro Max 256GB, đây là một dòng điện thoại mới và mạnh mẽ nhất của nhà Apple năm nay. Với thiết kế nguyên khối vuông vắn cùng nhiều màu sắc đẹp mắt hứa hẹn sẽ mang đến trải nghiệm thú vị cho người dùng.
            ',
            'image' => '/images/products/dien-thoai-iphone-12-pro-max-256gb-hang-chinh-hang.jpg',
            'price' => 37990000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại iPhone 12 Pro Max 128GB - Hàng Chính Hãng',
            'description' => '
            iPhone 12 Pro Max 128GB - Nâng tầm đẳng cấp sử dụng:
            Ngày 14/10 vừa qua, Apple đã trình làng iPhone 12 với các phiên bản làm điên đảo các tín đồ của nhà Táo. Apple năm nay lại ra thêm một chiếc iPhone mới với tên gọi mới là iPhone 12 Pro Max 128GB, đây là một dòng điện thoại mới và mạnh mẽ nhất của nhà Apple năm nay. Với thiết kế nguyên khối vuông vắn cùng nhiều màu sắc đẹp mắt hứa hẹn sẽ mang đến trải nghiệm thú vị cho người dùng.
            ',
            'image' => '/images/products/dien-thoai-iphone-12-pro-max-128gb-hang-chinh-hang.jpg',
            'price' => 31000000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Xiaomi 11T Pro 12GB/256GB - Hàng Chính Hãng',
            'description' => '
            Điện Thoại Xiaomi 11T Pro 12GB/256GB - Hàng Chính Hãng
            Bộ sản phẩm bao gồm: Pin, sạc, cáp USB kiểu C, cây tháo sim, ốp lưng, sách hướng dẫn.
            Thanh lịch trong từng chi tiết thiết kế
            ',
            'image' => '/images/products/dien-thoai-xiaomi-11t-pro-12gb-256gb-hang-chinh-hang.png',
            'price' => 14169000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện thoại Vivo X50 - Hàng Chính Hãng',
            'description' => '
            Màn hình tràn viền chuẩn xu hướng:
            Thiết kế bắt xu thế với màn hình Infinity-O, nâng cao khả năng hiển thị với độ phân giải Full HD+, cho không gian sử dụng thoải mái, trải nghiệm hình ảnh sống động với các bộ phim, video ca nhạc, dễ dàng đọc sách báo hằng ngày.
            ',
            'image' => '/images/products/dien-thoai-vivo-x50-hang-chinh-hang.jpg',
            'price' => 12990000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Samsung Galaxy S20 FE - Hàng Chính Hãng',
            'description' => '
            Thiết kế với gam màu cá tính:
            Tất cả những gì fan cần, nay đã có trong tầm tay. Bằng việc kế thừa những cải tiến của Galaxy S20, Samsung đã tạo nên một phiên bản đặc biệt dành riêng cho fans với đầy đủ các tính năng vượt trội có thể thoả mãn từ các game thủ, tín đồ nhiếp ảnh cho đến giới trẻ ưa thích sáng tạo, và đó chính là Samsung Galaxy S20 FE.
            ',
            'image' => '/images/products/dien-thoai-samsung-galaxy-s20-fe-hang-chinh-hang.jpg',
            'price' => 11950000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Samsung Galaxy A72 (8GB/256GB) - Hàng Chính Hãng',
            'description' => '
            Thiết kế hiện đại, sang trọng:
            Điện thoại Samsung Galaxy A72 8GB/256GB  Hàng chính hãng thiết kế nguyên khối đơn giản, trang nhã. Mặt lưng nhựa nhám cao cấp bóng bẩy, sang trọng và bền đẹp. Kích thước thân máy mỏng chỉ 8.4 mm, phần viền màn hình và cạnh bên vát cong nhẹ nhàng mềm mại tạo cảm giác cầm nắm chắc chắn và thuận tiện cho mọi tác vụ. Mặt lưng nổi bật cụm 4 camera, mặt kính cảm ứng trang bị kính cường lực chắc chắn chống va đập tốt.
            ',
            'image' => '/images/products/dien-thoai-samsung-galaxy-a72-8gb-256gb-hang-chinh-hang.jpg',
            'price' => 10575000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Samsung Galaxy Note 9 (128GB/6GB) - Hàng Nhập Khẩu',
            'description' => '
            Trợ lý đắc lực S Pen:
            S Pen trên Samsung Galaxy Note 9 không chỉ mang lại cảm giác ghi chú, viết vẽ như thật mà nó còn có rất nhiều tính năng hữu ích. Lần đầu tiên S Pen được kết nối Bluetooth với Galaxy Note 9. Nhờ thế bạn có thể điều khiển nhạc, chụp ảnh từ xa, điều khiển bài thuyết trình và nhiều tác vụ thông minh khác bằng S Pen. S Pen sẽ là người trợ lý đắc lực cho bạn để thực hiện những thao tác nhanh và tiện lợi chỉ có ở Note9.
            ',
            'image' => '/images/products/dien-thoai-samsung-galaxy-note-9-128gb-6gb-bac-hang.jpg',
            'price' => 9490000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Samsung Galaxy A71 (8GB/128GB) - Hàng Chính Hãng',
            'description' => '
            Thiết kế thời thượng, đẹp mắt:
            Điện Thoại Samsung Galaxy A71 được hoàn thiện từ khung kim loại chắc chắn cùng mặt lưng bằng nhựa giả kính với hiệu ứng chuyển màu cùng vết cắt kim cương đa sắc. Điều này giúp thiết bị trở nên thời thượng, bắt mắt hơn bao giờ hết. Không chỉ vậy, Galaxy A71 còn là chiếc smartphone có thiết kế tinh tế với độ mỏng chỉ 7.7 mm, tạo cảm giác thoải mái và thuận tiện khi cầm nắm trên tay. Mặt sau được tạo điểm nhấn ấn tượng với mặt cắt kim cương cùng các sắc màu thời thượng.
            ',
            'image' => '/images/products/dien-thoai-samsung-galaxy-a71-8gb-128gb-hang-chinh-hang.jpg',
            'price' => 10479000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Xiaomi 11T 8GB/128GB - Hàng Chính Hãng',
            'description' => '
            Điện Thoại Xiaomi 11T 8GB/128GB - Hàng Chính Hãng
            Bộ sản phẩm bao gồm: Pin, sạc, cáp USB kiểu C, cây tháo sim, ốp lưng, sách hướng dẫn.
            Thanh lịch trong từng chi tiết thiết kế
            ',
            'image' => '/images/products/dien-thoai-xiaomi-11t-8gb-128gb-hang-chinh-hang.png',
            'price' => 10334000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Oppo Reno 5G (8GB/128G) - Hàng Chính Hãng',
            'description' => '
            Từng đường nét lấp lánh, tỏa sáng:
            Điện Thoại Oppo Reno 5G (8GB/128G) có cấu tạo các khung viền xung quanh hoàn toàn bằng kim loại cao cấp, mặt lưng làm từ kính. Chiếc điện thoại được thiết kế tổng thể nguyên khối vô cùng rắn chắc và bo cong mềm mại ở 4 góc, mang đến người dùng cảm giác cầm nắm thoải mái nhất.
            ',
            'image' => '/images/products/dien-thoai-oppo-reno-5g-8gb-128g-hang-chinh-hang.jpg',
            'price' => 9990000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Oppo Reno 5 (8GB/128G) - Hàng Chính Hãng',
            'description' => '
            Camera chụp siêu nét, selfie cực đỉnh:
            Điện thoại OPPO Reno5 dùng chung hệ thống cảm biến cao cấp trên OPPO Reno5 Pro với cụm 4 camera sau gồm camera chính 64 MP, camera góc siêu rộng 8 MP, camera macro 2 MP và camera xóa phông 2 MP hứa hẹn đem đến chất lượng ảnh vô cùng ấn tượng. Cảm biến 64 MP cùng các camera phụ cung cấp nhiều tùy chọn chụp đa dạng từ chụp cận cảnh đến góc rộng, xóa phông dù ngày hay đêm, thỏa mãn đam mê nhiếp ảnh của bạn.
            ',
            'image' => '/images/products/dien-thoai-oppo-reno-5-8gb-128g-hang-chinh-hang.jpg',
            'price' => 7989000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện thoại Vivo Y72 5G - Hàng chính hãng',
            'description' => '
            Vivo Y72 5G mẫu smartphone 5G của Vivo, máy sở hữu một màn hình lớn, hiệu năng mạnh mẽ, cụm 3 camera sắc nét và thời lượng pin ấn tượng, máy đáp ứng tốt hầu hết nhu cầu sử dụng mà người dùng cần.
            ',
            'image' => '/images/products/dien-thoai-vivo-y72-5g.jpg',
            'price' => 7690000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);

        DB::table('products')->insert([
            'name' => 'Điện Thoại Xiaomi Redmi Note 10 Pro (8GB/128GB) - Hàng Chính Hãng',
            'description' => '
            Xiaomi tung ra mẫu smartphone có tên Xiaomi Redmi Note 10 Pro, với nhiều ưu điểm nổi bật từ thiết kế cho đến cấu hình, hứa hẹn sẽ tạo ra làn sóng mạnh mẽ trong cộng đồng người hâm mộ công nghệ.
            ',
            'image' => '/images/products/dien-thoai-xiaomi-redmi-note-10-pro-8gb-128gb-hang-chinh-hang.jpg',
            'price' => 7490000,
            'category' => 5,
            'rating_value' => rand(0, 5),
            'rating_times' => rand(0, 100)
        ]);
    }
}
