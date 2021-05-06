<?php

declare(strict_types=1);

namespace App\Form\User;

use App\Entity\User\User;
use App\Message\User\SendPasswordReset;
use App\Repository\User\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ForgotPasswordType extends AbstractType
{
    private UserRepository $userRepository;
    private TranslatorInterface $translator;

    public function __construct(
        UserRepository $userRepository,
        TranslatorInterface $translator
    ) {
        $this->userRepository = $userRepository;
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email',
                ]
            );

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();

                $data = $event->getData();

                $user = $this->userRepository->findOneBy([
                    'email' => $data->email,
                ]);

                if (!$user instanceof User) {
                    $form->get('email')->addError(
                        new FormError(
                            $this->translator->trans(
                                '%user% is not a known user',
                                [ 'user' => $data->email, ]
                            )
                        )
                    );
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', SendPasswordReset::class);
    }
}
