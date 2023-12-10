<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:create {id : id пользователя}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'создает токен для юзера';

    public function formatter()
    {
        $whiteStyle = new OutputFormatterStyle('white', 'default');
        $greenStyle = new OutputFormatterStyle('green', 'default');
        $yellowStyle = new OutputFormatterStyle('yellow', 'default');
        // $this->output->getFormatter()->setStyle('white', $whiteStyle);
        // $this->output->getFormatter()->setStyle('yellow', $yellowStyle);
        $this->output->getFormatter()->setStyle('green', $greenStyle);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->formatter();
        $id_user = $this->argument('id');
        $user = User::find($id_user);
        $token = $user->createToken('User Token')->accessToken;

        $this->output->writeln($token);

        return 0;
    }
}
