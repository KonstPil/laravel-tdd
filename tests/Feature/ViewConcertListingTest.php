<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Concert;
use Illuminate\Support\Carbon;

class ViewConcertListingTest extends TestCase
{

    use DatabaseMigrations;

   /** @test */
    function user_can_view_a_published_concert_listening()
    {
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13, 2016 20:00'),
            'ticket_price' => 3250,
            'venue' => "The MoshPit",
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '129123',
            'published_at'=> Carbon::parse('-2 week'),
            'additional_information' => 'For tickets, call (555) 555-5555.'
        ]);

        $response = $this->get('/concerts/'. $concert->id);

        $response->assertSee('The Red Chord');
        $response->assertSee('with Animosity and Lethargy');
        $response->assertSee('December 13, 2016');
        $response->assertSee('8:00pm');
        $response->assertSee('32.50');
        $response->assertSee('The MoshPit');
        $response->assertSee('Laraville, ON 129123');
        $response->assertSee('For tickets, call (555) 555-5555.');
    }

    /** @test */
    function user_can_view_a_unpublished_concert_listings()
    {
        $concert = factory(Concert::class)->create([
            'published_at' => null
        ]);

        $response = $this->get('/concerts/'. $concert->id);

        $response->assertStatus(404);
    }

}
