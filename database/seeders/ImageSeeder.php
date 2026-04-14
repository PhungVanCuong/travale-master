<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImageSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_images')->truncate();

        $images = [
            // Tour 1: Bà Nà
            ['tourId' => 1, 'imageURL' => 'https://vebanahill.vn/assets/images/hero/golden-bridge-hero.jpg', 'description' => 'Cầu Vàng Bà Nà'],
            ['tourId' => 1, 'imageURL' => 'https://vebanahill.vn/assets/images/hero/castle-hero.jpg', 'description' => 'Làng Pháp'],
            // Tour 2: Hạ Long
            ['tourId' => 2, 'imageURL' => 'https://www.vietnamvisa.org.vn/wp-content/uploads/2024/08/Halong-Bay-Vietnam-08.jpg', 'description' => 'Vịnh Hạ Long trên cao'],
            ['tourId' => 2, 'imageURL' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/05/12/87/bd/halong-bay.jpg?w=900&h=500&s=1', 'description' => 'Chèo thuyền Kayak'],
            // Tour 3: Phú Quốc
            ['tourId' => 3, 'imageURL' => 'https://danatravel.com.vn/data/files/1w-min.png', 'description' => 'Bãi sao Phú Quốc'],
            ['tourId' => 3, 'imageURL' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-A85dro9C_jO7QskUtkwYPBZLiZ5gkMrD7w&s', 'description' => 'Cáp treo Hòn Thơm'],
            // Tour 4: Tà Xùa
            ['tourId' => 4, 'imageURL' => 'https://bizweb.dktcdn.net/100/514/927/files/ta-xua.jpg?v=1755681677003', 'description' => 'Săn mây Tà Xùa'],
            ['tourId' => 4, 'imageURL' => 'https://pystravel.vn/_next/image?url=https%3A%2F%2Fbooking.pystravel.vn%2Fuploads%2Fposts%2Favatar%2F1729750291.jpg&w=3840&q=75', 'description' => 'Sống lưng khủng long'],
            // Tour 5: Di sản miền Trung
            ['tourId' => 5, 'imageURL' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRebVDSlJkoxwi_eh9b0aycEnkNDV5vq6AAQQ&s', 'description' => 'Đại Nội Huế'],
            ['tourId' => 5, 'imageURL' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9MyJ9JdGoihybQmWKxKnhMon_zspKspw0eg&s', 'description' => 'Phố cổ Hội An về đêm'],
            // Tour 6: Đà Lạt
            ['tourId' => 6, 'imageURL' => 'https://upload.wikimedia.org/wikipedia/commons/c/c7/TLTY2.jpg', 'description' => 'Thung lũng tình yêu'],
            ['tourId' => 6, 'imageURL' => 'https://agslandscape.vn/storage/lo/6h/lo6hofqyhupq07877l1jx001dckp_quang-truong-lam-vien-1.jpeg', 'description' => 'Quảng trường Lâm Viên'],
            // Tour 7: Miền Tây
            ['tourId' => 7, 'imageURL' => 'https://canthotourist.vn/public/upload/images/hinh_tour/cho-noi-cai-rang-khu-du-lich-my-khanh1700638771_804820298836395235.jpg', 'description' => 'Chợ nổi Cái Răng'],
            ['tourId' => 7, 'imageURL' => 'https://ik.imagekit.io/tvlk/blog/2023/06/vuon-trai-cay-can-tho-3.jpg?tr=q-70,c-at_max,w-1000,h-600', 'description' => 'Miệt vườn trái cây'],
            // Tour 8: Fansipan
            ['tourId' => 8, 'imageURL' => 'https://booking.muongthanh.com/upload_images/images/H%60/dinh-nui-fansipan.jpg', 'description' => 'Đỉnh Fansipan'],
            ['tourId' => 8, 'imageURL' => 'https://hnm.1cdn.vn/2023/09/23/a357.jpg', 'description' => 'Bản Cát Cát'],
            // Tour 9: Nha Trang
            ['tourId' => 9, 'imageURL' => 'https://buulong.com.vn/wp-content/uploads/2026/03/lan-ngam-san-ho-nha-trang-5.jpg', 'description' => 'Lặn ngắm san hô'],
            ['tourId' => 9, 'imageURL' => 'https://cdn.xanhsm.com/2025/02/e0a87a17-tam-bun-hon-tam-2.jpg', 'description' => 'Tắm bùn Hòn Tằm'],
            // Tour 10: Ninh Bình
            ['tourId' => 10, 'imageURL' => 'https://trangandanhthang.vn/wp-content/uploads/2025/06/khu-du-lich-trang-an-1.png', 'description' => 'Danh thắng Tràng An'],
            ['tourId' => 10, 'imageURL' => 'https://upload.wikimedia.org/wikipedia/commons/b/b2/Chua_Bai_Dinh_X8.JPG', 'description' => 'Chùa Bái Đính'],
        ];

        foreach ($images as &$img) {
            $img['uploadDate'] = Carbon::now();
        }

        DB::table('tbl_images')->insert($images);
    }
}
