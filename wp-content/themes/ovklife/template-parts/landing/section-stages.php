<?php
/**
 * Секция «Этапы работ» лендинга.
 *
 * Проблемы хаотичной реализации и наше решение —
 * инженерная интеграция в 3 шага.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$problems = array(
	array(
		'title' => 'Множество подрядчиков',
		'text'  => 'Инженерные системы проектируются и реализуются разными подрядчиками, что приводит к конфликтам трасс, оборудования и последовательности работ',
	),
	array(
		'title' => 'Архитектор и дизайнер берут лишнюю ответственность',
		'text'  => 'Им приходится координировать инженеров и принимать технические решения вне своей компетенции',
	),
	array(
		'title' => 'Даже при хорошем проекте изменения неизбежны',
		'text'  => 'Без системного подхода они начинают разрушать архитектуру и дизайн',
	),
);

$steps = array(
	array(
		'num'   => '01',
		'title' => 'Инженерный анализ проекта',
		'text'  => 'Изучаем архитектуру дома, планировки и дизайн-проект. Определяем требования к инженерным системам, возможные ограничения и точки потенциальных конфликтов между системами',
	),
	array(
		'num'   => '02',
		'title' => 'Интеграция инженерных систем',
		'text'  => 'Увязываем и проектируем между собой все инженерные системы дома. Определяем приоритеты систем и порядок их реализации',
	),
	array(
		'num'   => '03',
		'title' => 'Проектирование и реализация инженерных систем',
		'text'  => 'После инженерной увязки мы разрабатываем проект инженерных систем и реализуем его на объекте. Наша команда отвечает за монтаж инженерных систем и обеспечивает соответствие реализации проектным решениям',
	),
);

$systems = array( 'отопление', 'вентиляция', 'электрика', 'водоснабжение', 'оборудование' );
?>

<section id="ehtapy-rabot" class="landing-section stages">
	<div class="landing-container">
		<!-- Блок проблем -->
		<div class="stages__problems">
			<h2 class="stages__title">
				<?php esc_html_e( 'Реальность реализации инженерных систем на стройке', 'ovklife' ); ?>
			</h2>
			<p class="stages__subtitle">
				<?php esc_html_e( 'Даже при хорошем архитектурном и дизайн-проекте инженерная часть часто реализуется хаотично', 'ovklife' ); ?>
			</p>

			<div class="stages__problems-list">
				<?php foreach ( $problems as $problem ) : ?>
				<div class="stages__problem">
					<h3 class="stages__problem-title">
						<?php echo esc_html( $problem['title'] ); ?>
					</h3>
					<p class="stages__problem-text">
						<?php echo esc_html( $problem['text'] ); ?>
					</p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>

		<hr class="landing-divider stages__divider">

		<!-- Блок решения -->
		<div class="stages__solution">
			<h2 class="stages__solution-title">
				<?php esc_html_e( 'Как мы организуем инженерную часть проекта', 'ovklife' ); ?>
			</h2>
			<p class="stages__solution-subtitle">
				<?php esc_html_e( 'Инженерные системы аккуратно вписываются в архитектуру дома и сохраняют задуманный дизайн без переделок', 'ovklife' ); ?>
			</p>
			<p class="stages__solution-desc">
				<?php esc_html_e( 'Мы подключаемся к проекту как инженерный интегратор и заранее увязываем инженерные системы между собой и с архитектурой дома. Это позволяет избежать хаоса подрядчиков и минимизировать изменения на стадии реализации', 'ovklife' ); ?>
			</p>
		</div>

		<!-- Этапы -->
		<div class="stages__steps">
			<?php foreach ( $steps as $step ) : ?>
			<div class="stages__step">
				<span class="stages__step-num"><?php echo esc_html( $step['num'] ); ?></span>
				<h3 class="stages__step-title"><?php echo esc_html( $step['title'] ); ?></h3>
				<p class="stages__step-text"><?php echo esc_html( $step['text'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>

		<!-- Системы -->
		<p class="stages__systems-label"><?php esc_html_e( 'Этапы работы', 'ovklife' ); ?></p>
		<div class="stages__systems">
			<?php foreach ( $systems as $system ) : ?>
			<span class="stages__system"><?php echo esc_html( $system ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
