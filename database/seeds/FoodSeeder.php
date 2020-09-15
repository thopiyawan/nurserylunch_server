<?php

use Illuminate\Database\Seeder;

use App\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $food_thai = array(
            "ข้าวบด ไข่แดง-ตำลึง 6-8 เดือน", "ข้าวบด ตับไก่-เต้าหู้ ผักหวาน 6-8 เดือน", "ข้าวบด ปลาทู ฟักทอง 6-8 เดือน", "ข้าวต้ม ไข่-ตำลึง 9-11 เดือน", "ข้าวต้ม ปลา-แครอท 9-11 เดือน", "ข้าวผัดไข่ แกงจืดไก่ ผักหวาน ฟักทอง 12-23 เดือน", "ข้าว เต้าหู้อ่อนทอด ต้มเลือดหมู หมูสับ แครอท ตำลึง 12-23 เดือน",
            "ข้าว ปลาทู ไข่น้ำ มันฝรั่ง หัวผักกาด 12-23 เดือน", "ข้าวบดปลาทูใส่ใบตำลึง", "ข้าวบดปลาช่อนใส่ฟักทอง", "ข้าวบดเนื้อหมูใส่แครอท", "ข้าวบดตับไก่ใส่มะเขือเทศ", "ข้าวบดปลานิลใส่ใบผักบุ้ง"
        );
        $food_eng = array("Egg Yolk Mashed Rice - Gourd 6-8 months", "Chicken Liver - Tofu, Phak Wan, Rice 6-8 months", "Mackerel Mashed Rice 6-8 months", "Boiled rice with eggs - gourd salad 9-11 months", "Fish-Carrot Porridge 9-11 months", "Boiled rice with minced pork - Pakwan blood 9-11 months", "Egg Fried Rice, Clear Soup with Chicken, Vegetable and Pumpkin 12-23 months", "Fried Baby Tofu with Boiled Pork Blood, Minced Pork, Carrot Gourd 12-23 months", "Rice, mackerel, egg, potato juice, turnip 12-23 months", "Mackerel Mashed Rice with Gourd Leaves", "Snakehead Fish Mashed Rice with Pumpkin", "Pork Minced Rice with Carrot", "Chicken Liver Mashed Rice with Tomato", "Tilapia Ground Rice with Morning Glory Leaves");

        foreach ($food_thai as $key => $food) {
            $food = new Food();
            $food->food_group = 10;
            $food->food_thai = $food_thai[$key];
            $food->food_eng =  $food_eng[$key];
            $food->save();
        }
    }
}
