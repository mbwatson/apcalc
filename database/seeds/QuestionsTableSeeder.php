<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder {
	public function run()
	{
		DB::table('questions')->delete();

		$seeds = array(
			array(
				'id' => 1,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Power Series: Convergence & Error Bound',
				'body' => 'The function $f$ is defined by the power series
					$$f(x) = \sum_{n=0}^\infty\frac{(x-2)^n}{3^n(n+1)} = 1 + \frac{x-2}{3 \cdot 2} + \frac{(x-2)^2}{3^2\cdot 3} + \frac{(x-2)^3}{3^3\cdot 4} + \cdots  + \frac{(x-2)^n}{3^n(n+1)} + \cdots.$$

(a) Determine the interval of convergence of the power series for $f$. Show the work that leads to your answer.

(b) Find the value of $f\'\'(2)$.

(c) Use the first three nonzero terms of the power series for $f$ to approximate $f(1)$. Use the alternating series error bound to show that this approximation differs from $f(1)$ by less than $\frac{1}{100}$.',
				'user_id' => 1,
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			),
			array(
				'id' => 2,
				'type' => '1',
				'calculator' => '0',
				'title' => 'An Improper Integral',
				'body' => 'Consider the function $f$ given by $f(x) = xe^{-2x}$ for all $x \geq 0$.
					
(a) Find $\lim_{x\to\infty}f(x)$.

(b) Find the maximum value of $f$ for $x \geq 0$. Justify your answer.

(c) Evaluate $\int_0^\infty f(x) dx$, or show that the integral diverges.',
				'user_id' => 2,
				'created_at' => Carbon::now()->addSecond(1)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(1)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 3,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Power series and $\sin(x)/x$',
				'body' => '
Consider the function defined by $f(x)=\frac{\sin(x)}{x}$.
				
(a) Find a power series representation of $f$ centered at $x=0$.

(b) The power series you found in part (a) is not quite a Maclaurin series for $f$ because $f$ is technically not eligible to have a Maclaurin series. Why?
					
(c) Redefine $f$ as follows: $f(x) = \begin{cases}\frac{\sin(x)}{x} &: x \ne 0;\newline k &: x=0.\end{cases}$ The power series in part (a) will be a Maclaurin series for this newly defined $f$. What is the value of $k$?',
				'user_id' => '1',
				'created_at' => Carbon::now()->addSecond(2)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(2)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 4,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Function Analysis via its Taylor Series',
				'body' => '
The function $f$ has a Taylor series about $x=2$ that converges to $f(x)$ for all $x$ in the interval of convergence.
The $n$th derivative of $f$ at $x=2$ is given by $f^{(n)}(2) = \frac{(n+1)!}{3^n}$ for all $n \ge 1$ and $f(2) = 1$.

(a) Write the first four terms and the general term of the Taylor series for $f$ about $x=2$.

(b) Find the radius of convergence for the Taylor series for $f$ about $x=2$. Show the work that leads to your answer.

(c) Let $g$ be a function satisfying $g(2)=3$ and $g\'(x)=f(x)$ for all $x$.
Write the first four terms and the general term of the Taylor series for $g$ about $x=2$.

(d) Does the Taylor series for $g$ as defined in part (c) converge at $x=-2$? Give a reason for your answer.',
				'user_id' => '2',
				'created_at' => Carbon::now()->addSecond(3)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(3)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 5,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Analyzing a Maclaurin Series',
				'body' => '
The Maclaurin series for the function $f$ is given by 
$$
f(x)= \sum_{n=0}^\infty\frac{(2x)^{n+1}}{n+1}
    = 2x + \frac{4x^2}{2} + \frac{8x^3}{3} + \frac{16x^4}{4} + \cdots + \frac{(2x)^{n+1}}{n+1} + \cdots
$$
on its interval of convergence.

(a) Find the interval of convergence for the Maclaurin series for $f$. Justify your answer.

(b) Find the first four terms and the general term for the Maclaurin series for $f\'(x)$.

(c) Use the Maclaurin series you found in part (b) to find the value of $f\'(-\tfrac{1}{3})$.',
				'user_id' => '1',
				'created_at' => Carbon::now()->addSecond(4)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(4)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 6,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Graph Interpretation',
				'body' => '
<p style="text-align: center;"><img src="/images/2/1234567890_png.png" width="241" height="275" /></p>
<p>Let $f$ be a continuous function defined on the closed interval $-1 \leq x \leq 4$. The graph of $f$, consisting of three line segments, is shown above. Let $g$ be the function defined by $g(x) = 5 + \int_2^x f(t)dt$ for $-1 \leq x \leq 4$.</p>
<p>(a) Find $g(4)$.</p>
<p>(b) On what intervals is $g$ increasing? Justify your answer.</p>
<p>(c) On the closed interval $-1 \leq x \leq 4$, find the absolute minimum value of $g$ and find the absolute maximum value of $g$. Justify your answers.</p>
<p>(d) Let $h(x) = x \cdot g(x)$. Find $h\'(2)$.</p>',
				'user_id' => '2',
				'created_at' => Carbon::now()->addSecond(5)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(5)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 7,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Solid Generated by Two Curves',
				'body' => '
<p style="text-align: center;"><img src="/images/1/Screenshot_from_2016-07-28_09_56_03_png.png" width="213" height="220" /></p>
<p>Let $R$ be the region in the first quadrant bounded by the graph of $g$, and let $S$ be the region in the first quadrant between the graphs of $f$ and $g$, as shown in the figure above. The region in the first quadrant bounded by the graph of $f$ and the coordinate axes has area 12.142. The function $g$ is given by $g(x) = (\sqrt{x+6})\cos\Big(\frac{\pi x}{8}\Big)$, and the function $f$ is not explicitly given. The graphs of $f$ and $g$ intersect at the point $(4,0)$.</p>
<p>(a) Find the area of $S$.</p>
<p>(b) A Solid is generated when $S$ is revolved about the horizontal line $y=5$. Write, but do not evaluate, an expression involving one or more integrals that gives the volume of the solid.</p>
<p>(c) Region $R$ is the base of an art sculpture. At all points in $R$ at a distance $x$ from the $y$-axis, the height of the sculpture is given by $h(x) = 4 - x$. Find the volume of the art sculpture.</p>',
				'user_id' => '1',
				'created_at' => Carbon::now()->addSecond(6)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(6)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 8,
				'type' => '1',
				'calculator' => '0',
				'title' => 'Integration and Stationary Bicycles',
				'body' => '
<p style="text-align: center;"><img src="/images/1/Screenshot_from_2016-07-28_11_24_45_png.png" width="473" height="102" /></p>
<p>Rochelle rode a stationary bicycle. The number of rotations per minute of the wheel of the&nbsp;stationary bicycle at time $t$ minutes during Rochelle&rsquo;s ride is modeled by a differentiable function $r$ for $0 \leq t \leq 9$ minutes. Values of $r(t)$&nbsp;for selected values of $t$ are shown in the table above.</p>
<p>(A) Estimate $r\'(4)$.&nbsp;Show the computations that lead to your answer. Indicate units of measure.</p>
<p>(B) Is there a time $t$, for $3 \leq t \leq 5$, at which $r(t)$ is 106 rotations per minute?&nbsp;Justify your answer.</p>
<p>(C) Use a left Riemann sum with the four subintervals indicated by the data in the table to&nbsp;approximate $\int_0^9 r(t)dt$.&nbsp;Using correct units, explain the meaning of $\int_0^9 r(t)dt$</p>
<p>in the&nbsp;context of the problem.</p>
<p>(D) Sarah also rode a stationary bicycle. The number of rotations per minute of the wheel of&nbsp;the stationary bicycle at time $t$ minutes during Sarah&rsquo;s ride is modeled by the function $s$,</p>
<p>defined by $s(t) = 40 + 20\pi\sin\Big(\frac{\pi t}{18}\Big)$&nbsp;for $0 \leq t \leq 9$&nbsp;minutes. Find the average number of&nbsp;rotations per minute of the wheel of the stationary bicycle for $0 \leq t \leq 9$&nbsp;minutes.</p>',
				'user_id' => '1',
				'created_at' => Carbon::now()->addSecond(7)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(7)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 9,
				'type' => '2',
				'calculator' => '1',
				'title' => 'Value from an Antiderivative',
				'body' => '
<p>Let $h$ be the function defined by $h(x) = \frac{1}{\sqrt{x^5 + 1}}$. If $g$ is an antiderivative of $h$ and $g(2) = 3$, what is the value of $g(4)$?</p>
<p>(A) -0.020</p>
<p>(B) 0.152</p>
<p>(C) 3.031</p>
<p>(D) 3.152</p>',
				'user_id' => '2',
				'created_at' => Carbon::now()->addSecond(8)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(8)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 10,
				'type' => '2',
				'calculator' => '0',
				'title' => 'Limits from Graph',
				'body' => '
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/images/1/Screenshot_from_2016-08-07_02_31_59_png.png" alt="" width="505" height="310" /></p>
<p>&nbsp;</p>
<p>The graphs of the functions $f$ and $g$ are shown above. The value of $\lim_{x\to1}f(g(x))$ is</p>
<p>(A) 1</p>
<p>(B) 2</p>
<p>(C) 3</p>
<p>(D) nonexistent</p>',
				'user_id' => '2',
				'created_at' => Carbon::now()->addSecond(9)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(9)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 11,
				'type' => '2',
				'calculator' => '0',
				'title' => 'Simple Limit',
				'body' => '
<p>$\lim_{x\to0}\frac{7x - \sin(x)}{x^2 + \sin(3x)} = $</p>
<p>(A) 6</p>
<p>(B) 2</p>
<p>(C) 1</p>
<p>(D) 0</p>',
				'user_id' => '1',
				'created_at' => Carbon::now()->addSecond(10)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(10)->format('Y-m-d H:i:s')
			),
			array(
				'id' => 12,
				'type' => '2',
				'calculator' => '0',
				'title' => 'Linear Approximation',
				'body' => '
<p>The local linear approximation to the function $g$ at $x = \frac{1}{2}$ is $y = 4x + 1$.
What is the value of $g\Big(\frac{1}{2}\Big) + g\'\Big(\frac{1}{2}\Big)$</p>
<p>(A) 4</p>
<p>(B) 5</p>
<p>(C) 6</p>
<p>(D) 7</p>',
				'user_id' => '2',
				'created_at' => Carbon::now()->addSecond(10)->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->addSecond(10)->format('Y-m-d H:i:s')
			),
		);

		DB::table('questions')->insert($seeds);

		foreach (App\Question::all() as $question) {
			$question->slug = str_slug($question->title);
			$question->save();
		}
		
	}
}