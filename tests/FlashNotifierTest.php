<?php

namespace MercurySeries\FlashyBundle\Tests;

use PHPUnit\Framework\TestCase;
use MercurySeries\FlashyBundle\FlashyNotifier;

class FlashyTest extends TestCase
{
    private $session;

    private $flashy;
    
    public function setUp(): void
    {
        $this->session = $this->createMock('MercurySeries\FlashyBundle\SessionStore');

        $this->flashy = new FlashyNotifier($this->session);
    }
    
    /** @test */
    public function it_displays_default_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Welcome Aboard',
                'link' => '#',
                'type' => 'success'
            ]);

        $this->flashy->message('Welcome Aboard');
    }
    
    /** @test */
    public function it_displays_info_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Welcome Aboard',
                'link' => '#',
                'type' => 'info'
            ]);
            
        $this->flashy->info('Welcome Aboard');
    }
    
    /** @test */
    public function it_displays_success_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Welcome Aboard',
                'link' => '#',
                'type' => 'success'
            ]);

        $this->flashy->success('Welcome Aboard');
    }
    
    /** @test */
    public function it_displays_error_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Uh Oh',
                'link' => '#',
                'type' => 'error'
            ]);
            
        $this->flashy->error('Uh Oh');
    }
    
    /** @test */
    public function it_displays_warning_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Be careful!',
                'link' => '#',
                'type' => 'warning'
            ]);
            
        $this->flashy->warning('Be careful!');
    }
    
    /** @test */
    public function it_displays_primary_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Thanks for signing up!',
                'link' => '#',
                'type' => 'primary'
            ]);
            
        $this->flashy->primary('Thanks for signing up!');
    }
    
    /** @test */
    public function it_displays_primary_dark_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Thanks for signing up!',
                'link' => '#',
                'type' => 'primary-dark'
            ]);
            
        $this->flashy->primaryDark('Thanks for signing up!');
    }
    
    /** @test */
    public function it_displays_muted_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Can you see me?',
                'link' => '#',
                'type' => 'muted'
            ]);
            
        $this->flashy->muted('Can you see me?');
    }
    
    /** @test */
    public function it_displays_muted_dark_flashy_notifications()
    {
        $this->session
            ->expects($this->once())
            ->method('flash')
            ->with('mercuryseries_flashy_notification', [
                'message' => 'Can you see me?',
                'link' => '#',
                'type' => 'muted-dark'
            ]);
            
        $this->flashy->mutedDark('Can you see me?');
    }
}
