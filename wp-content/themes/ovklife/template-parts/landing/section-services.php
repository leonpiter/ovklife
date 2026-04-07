<?php
/**
 * Секция «Услуги» лендинга.
 *
 * 5 направлений: отопление, вентиляция, электрика,
 * водоснабжение, автоматизация.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$services = array(
	array(
		'icon'  => 'tild6365-3030-4535-b965-653563623431__group_8.svg',
		'title' => 'Отопление',
		'desc'  => 'Комфортная температура в доме без перегрева и переделок',
	),
	array(
		'icon'  => 'tild6534-3433-4661-b864-323738613665__group_13.svg',
		'title' => 'Вентиляция',
		'desc'  => 'Свежий воздух без шума и лишних воздуховодов',
	),
	array(
		'icon'  => 'tild6537-3733-4230-a232-653936656564__group_14.svg',
		'title' => 'Электроснабжение',
		'desc'  => 'Надежное электроснабжение с учетом всех нагрузок дома',
	),
	array(
		'icon'  => 'tild6433-6266-4430-b437-396536373131__group_15.svg',
		'title' => 'Водоснабжение и канализация',
		'desc'  => 'Стабильная работа воды и канализации без сюрпризов на объекте',
	),
	array(
		'icon'  => 'tild6365-3632-4436-a263-316437666234__group_18.svg',
		'title' => 'Автоматизация и слаботочные системы',
		'desc'  => 'Управление инженерией и безопасностью в единой системе',
	),
);
?>

<section id="uslugi" class="landing-section landing-section--light services">
	<div class="landing-container">
		<div class="services__header">
			<p class="services__label"><?php esc_html_e( 'Услуги', 'ovklife' ); ?></p>
			<h2 class="services__title"><?php esc_html_e( 'Что мы проектируем и реализуем', 'ovklife' ); ?></h2>
		</div>

		<div class="services__grid">
			<?php foreach ( $services as $service ) : ?>
			<div class="services__card">
				<div class="services__card-icon">
					<?php ovklife_svg_icon( $service['icon'], 'services__icon' ); ?>
				</div>
				<h3 class="services__card-title"><?php echo esc_html( $service['title'] ); ?></h3>
				<p class="services__card-desc"><?php echo esc_html( $service['desc'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
