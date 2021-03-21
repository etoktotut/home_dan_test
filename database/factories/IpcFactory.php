<?php

namespace Database\Factories;

use App\Models\IPC;
use Illuminate\Database\Eloquent\Factories\Factory;

class IpcFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IPC::class ;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'pn' =>$this->faker->bothify('IPC-???####??'),
          'vendor_id'=>random_int(1,3),
          'type_id'=>random_int(1,2), //ограничимся куполками и буллетами
          'small_image'=>'DH-IPC-HFW2230S-S-S2_small.png',
          'lenstype_id'=>random_int(1,2),
          'sens_size'=>$this->faker->randomElement(['1/1.8','1/2.7','1/2.8'],1),
          'resolution'=>$this->faker->randomElement(['1920x1080','720x576','2544x1280'],1),
          'resolution_MP'=>$this->faker->randomElement([2,3,4,5,8],1),
          'near_fl'=>$this->faker->randomElement([2.8,3.6,4.0,5.1,8.0],1),
           'far_fl'=>$this->faker->randomElement([12.7,13.5,35,50,0],1),
          // $table->float('zoomx',4,1);
          // $table->float('h_angle_wide',5,2);
          'h_angle_wide'=>$this->faker->numberBetween(55,120),
          //$this->faker->randomElement([110,87,56,92,107,103,78,93,84,85,],1)
          // $table->float('h_angle_tele',5,2)->nullable();
          // $table->unsignedTinyInteger('streams');
          'streams'=>random_int(2,4),
          // $table->string('codecs');
          // $table->string('power_type');
          // $table->float('power_consumption',5,2)->default(5.9);
          'power_consumption'=>$this->faker->randomElement([4.3,5.9,6.2,6.4,8,10.5,18,23]),
          // $table->unsignedTinyInteger('lighttype_id')->default(1);
          'light_distance'=>$this->faker->randomElement([0,10,20,30,40,50,60,80,100]),
          // $table->unsignedSmallInteger('light_distance')->default(0);
          // $table->boolean('mic')->default(false);
          'mic'=>$this->faker->randomElement([true,false]),
          // $table->boolean('audion_in')->default(false);
          // $table->boolean('audio_out')->default(false);
          // $table->unsignedTinyInteger('alarm_in')->default(0);
          // $table->unsignedTinyInteger('alarm_out')->default(0);
          // $table->unsignedTinyInteger('hight_temp');
          // $table->tinyInteger('low_temp');
          // $table->string('protection_class');
          'protection_class'=>$this->faker->randomElement(['IP67','IP67,IK10','','IP66','IP68,IK10'])
          // $table->integer('micro_sd');
          // $table->boolean('wifi')->default(false);
          // $table->boolean('is_rchive')->default(false);
          // $table->boolean('is_eol')->default(false);
          // $table->text('fromprice_description',500);
            //
        ];
    }
}
