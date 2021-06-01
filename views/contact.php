<?php
/** @var $this \app\core\View
 *  @var $contact \app\models\Contact
 */
$this->title = 'Contact';
?>
<div class="container">
    <h1>Contact Us</h1>
    <form action="" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control <?= $contact->hasError('name') ? 'is-invalid' : '' ?>" value="<?= $contact->name ?? '' ?>">
            <span class="invalid-feedback"><?= $contact->getFirstError('name') ?></span>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control <?= $contact->hasError('email') ? 'is-invalid' : '' ?>" value="<?= $contact->email ?? '' ?>">
            <span class="invalid-feedback"><?= $contact->getFirstError('email') ?></span>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control <?= $contact->hasError('subject') ? 'is-invalid' : '' ?>">
            <span class="invalid-feedback"><?= $contact->getFirstError('subject') ?></span>
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="form-control <?= $contact->hasError('message') ? 'is-invalid' : '' ?>"><?= $contact->message ?></textarea>
            <span class="invalid-feedback"><?= $contact->getFirstError('message') ?></span>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>