<?php


class Student
{
    private string $name;
    private int $score;

    public function __construct(string $name, int $score)
    {
        $this->name = $name;
        $this->score = $score;
    }

    public function __toString()
    {
        return sprintf("Student(name: %s, score: %d)", $this->name, $this->score);
    }
}
