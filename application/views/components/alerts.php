
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


<?php if($this->session->flashdata('info')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('info', '<?php echo $this->session->flashdata('info') ?>', 'dark');
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('loading')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('loading', '<?php echo $this->session->flashdata('loading') ?>', 'dark');
        });
    </script>
<?php endif; ?>

