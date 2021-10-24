<?php

namespace Tests\Feature;

use App\Models\FbPhoto;
use Carbon\Carbon;
use Database\Factories\FbPhotoFactory;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FbPhotoServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Case for store photo
     * @return void
     */
    public function test_can_store_photo()
    {
       $formData = [
           'title'   => 'Test Title',
           'picture' => 'Test Picture Url',
           'user_id' =>  1,
       ];

       $this->json('POST', route('fb_photos.store'),$formData)
           ->assertStatus(201);

    }

    /**
     * Test case for get one photo
     */
    public function test_can_show_photo()
    {
        $fake_photo = FbPhoto::factory()->create();
        $this->get(route('fb_photos.show',$fake_photo->id))
            ->assertStatus(200);

    }


    /**
     * Test Case for update photo
     * @return void
     */
    public function test_can_update_photo()
    {
        $fake_photo = FbPhoto::factory()->create();

        $updatedData = [
            'title'   => 'Second Title',
            'picture' => 'Second Picture Url',
            'user_id' =>  2,
        ];

        $this->json('PUT', route('fb_photos.update',$fake_photo->id),$updatedData)
            ->assertStatus(202);

    }

    /**
     * Test Case for delete photo
     */
    public function test_can_delete_photo(){
        $fake_photo = FbPhoto::factory()->create();

        $this->delete(route('fb_photos.destroy',$fake_photo->id))
            ->assertStatus(204);
    }
}
