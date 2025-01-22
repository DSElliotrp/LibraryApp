<p>Dear {{ $user->name }},</p>
<p>We hope you enjoy reading {{ $book->title }}!</p>
<p>Don't forget to return it by {{ $borrowing->due_at }}.</p>