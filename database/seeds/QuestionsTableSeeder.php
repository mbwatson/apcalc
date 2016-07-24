<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder {
	public function run()
	{
		DB::table('questions')->delete();

		$seeds = array(
			array(
				'title' => 'Power Series: Convergence & Error Bound',
				'body' => 'The function $f$ is defined by the power series
					$$f(x) = \sum_{n=0}^\infty\frac{(x-2)^n}{3^n(n+1)} = 1 + \frac{x-2}{3 \cdot 2} + \frac{(x-2)^2}{3^2\cdot 3} + \frac{(x-2)^3}{3^3\cdot 4} + \cdots  + \frac{(x-2)^n}{3^n(n+1)} + \cdots$$

(a) Determine the interval of convergence of the power series for $f$. Show the work that leads to your answer.

(b) Find the value of $f\'\'(2)$.

(c) Use the first three nonzero terms of the power series for $f$ to approximate $f(1)$. Use the alternating series error bound to show that this approximation differs from $f(1)$ by less than $\frac{1}{100}$.',
				'user_id' => 1,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			),
			array(
				'title' => 'An Improper Integral',
				'body' => 'Consider the function $f$ given by $f(x) = xe^{-2x}$ for all $x \geq 0$.
					
(a) Find $\lim_{x\to\infty}f(x)$

(b) Find the maximum value of $f$ for $x \geq 0$. Justify your answer.

(c) Evaluate $\int_0^\infty f(x)\,dx$, or show that the integral diverges.',
				'user_id' => 2,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			),
			array(
				'title' => 'Power series and $\sin(x)/x$',
				'body' => '
Consider the function defined by $f(x)=\frac{\sin(x)}{x}$.
				
(a) Find a power series representation of $f$ centered at $x=0$.

(b) The power series you found in part (a) is not quite a Maclaurin series for $f$ because $f$ is technically not eligible to have a Maclaurin series. Why?
					
(c) Redefine $f$ as follows: $f(x) = \begin{cases}\frac{\sin(x)}{x} &: x \ne 0;\newline k &: x=0.\end{cases}$ The power series in part (a) will be a Maclaurin series for this newly defined $f$. What is the value of $k$?',
				'user_id' => '1',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			),
			array(
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
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			),
			array(
				'title' => 'Analyzing a Maclaurin Series',
				'body' => '
The Maclaurin series for the function $f$ is given by 
$$
f(x)= \sum_{n=0}^\infty\frac{(2x)^{n+1}}{n+1}
    = 2x + \frac{4x^2}{2} + \frac{8x^3}{3} + \frac{16x^4}{4} + \cdots + \frac{(2x)^{n+1}}{n+1} + \cdots
$$
on its interval of convergence.

(b) Find the interval of convergence for the Maclaurin series for $f$. Justify your answer.

(b) Find the first four terms and the general term for the Maclaurin series for $f\'(x)$.

(c) Use the Maclaurin series you found in part (b) to find the value of $f\'(-\tfrac{1}{3})$.',
				'user_id' => '1',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			),
		);

		DB::table('questions')->insert($seeds);
	}
}