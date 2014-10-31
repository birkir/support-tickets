<?php

class TicketSupportSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Clear our database
		DB::table('categories')->delete();
		DB::table('tickets')->delete();
		DB::table('tickets_categories')->delete();
		DB::table('ticket_messages')->delete();
		DB::table('users')->delete();

		// Create admin role
		$admin = new Role;
		$admin->name = 'admin';
		$admin->save();

		// Create sample user
		$user = User::create([
			'email' => 'demo@demo.com',
			'password' => Hash::make('demo')
		]);
		$user->attachRole($admin);

		// Create sample categories
		$sampleCategories = array([
			'name' => 'Demo category',
			'position' => 1
		], [
			'name' => 'Other stuff',
			'position' => 2
		]);
		$categories = array();

		foreach ($sampleCategories as $sampleCategory)
		{
			// Create category
			$categories[] = Category::create($sampleCategory);
		}

		$this->command->info('Categories created!');

		$faker = Faker\Factory::create();
		$ticketsToCreate = 10;

		for ($i = 0; $i < $ticketsToCreate; $i++)
		{
			$sampleTicket = [
				'title' => $faker->sentence(6),
				'message' => join('<br>', $faker->paragraphs($faker->numberBetween(2,10))),
				'status' => 1
			];

			// Create ticket and attach category
			$ticket = Ticket::create($sampleTicket);

			// Attach user to ticket
			$ticket->user()->associate($user);

			// Attach to random category
			$ticket->categories()->attach($faker->randomElement($categories)->id);

			// Create random number of messages
			for ($x = 0; $x < $faker->numberBetween(2, 6); $x++)
			{
				$sampleMessage = [
					'message' => join('<br>', $faker->paragraphs($faker->numberBetween(2,10)))
				];

				$message = TicketMessage::create($sampleMessage);

				$message->user()->associate($user);

				$ticket->messages()->save($message);

				$message->save();
			}

			$ticket->save();
		}

		$this->command->info('Created 10 sample tickets!');
	}

}

