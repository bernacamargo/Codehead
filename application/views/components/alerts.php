<?php if($this->session->flashdata('success')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('success', '<?php echo $this->session->flashdata('success') ?>');
        });
    </script>
<?php endif; ?>


<?php if($this->session->flashdata('error')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('error', '<?php echo $this->session->flashdata('error') ?>');
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('warning')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('warning', '<?php echo $this->session->flashdata('warning') ?>');
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('info')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('info', '<?php echo $this->session->flashdata('info') ?>');
        });
    </script>
<?php endif; ?>


<?php if($this->session->flashdata('loading')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('loading', '<?php echo $this->session->flashdata('loading') ?>');
        });
    </script>
<?php endif; ?>

