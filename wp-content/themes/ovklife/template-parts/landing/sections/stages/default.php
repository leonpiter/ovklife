<?php
/**
 * Шаблон секции «Этапы работ» (вариант default).
 *
 * Проблемы хаотичной реализации и наше решение —
 * инженерная интеграция в 3 шага.
 *
 * Переменные из data.php:
 *
 * @var string $stages_title             Заголовок блока проблем.
 * @var string $stages_subtitle          Подзаголовок блока проблем.
 * @var string $stages_solution_title    Заголовок решения.
 * @var string $stages_solution_subtitle Подзаголовок решения.
 * @var string $stages_solution_desc     Описание решения.
 * @var string $stages_systems_label     Подпись тегов систем.
 * @var array  $problems                 Массив проблем (title, text).
 * @var array  $steps                    Массив шагов (num, title, text).
 * @var array  $systems                  Массив названий систем.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="ehtapy-rabot" class="landing-section stages">
	<div class="landing-container">
		<!-- Блок проблем -->
		<div class="stages__problems">
			<h2 class="stages__title">
				<?php echo esc_html( $stages_title ); ?>
			</h2>
			<p class="stages__subtitle">
				<?php echo esc_html( $stages_subtitle ); ?>
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
				<?php echo esc_html( $stages_solution_title ); ?>
			</h2>
			<p class="stages__solution-subtitle">
				<?php echo esc_html( $stages_solution_subtitle ); ?>
			</p>
			<p class="stages__solution-desc">
				<?php echo esc_html( $stages_solution_desc ); ?>
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
		<p class="stages__systems-label"><?php echo esc_html( $stages_systems_label ); ?></p>
		<div class="stages__systems">
			<?php foreach ( $systems as $system ) : ?>
			<span class="stages__system"><?php echo esc_html( $system ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
