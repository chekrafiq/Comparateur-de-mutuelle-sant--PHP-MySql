/*
 ** chg_owner.c
 ** 
 ** Made by (François-Xavier BOIS)
 ** Login   <fx@kernix.com>
 ** 
 ** Started on  Tue Apr  3 22:40:23 2001 François-Xavier BOIS
 ** Last update Tue Apr  3 22:40:23 2001 François-Xavier BOIS
 */

#include <pwd.h>
#include <stdio.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <unistd.h>

void	info_process()
{
  uid_t                uid;
  uid_t                euid;
  struct passwd        *p;
  
  printf("pid = ");
  printf("%d",getpid());
  uid = getuid();
  p = getpwuid(uid);
  printf(" [%s ",p->pw_name);
  euid = geteuid();
  p = getpwuid(uid);
  printf("%s]\n",p->pw_name);
}

int	main(argc, argv)
int	argc;
char	**argv;
{
  int	tmp;
  char	*dirname;
  FILE	*errorstream;
  
  if (fork())
   {
     wait(NULL);
/*     printf("je suis le pere\n");*/
/*     info_process();*/
   }
  else
  {
/*    errorstream = fopen("/dev/console","r");*/
    dirname = argv[1];
/*    printf("premier argument : %s\n",dirname);*/
    tmp = chown(dirname,0,0);
    if (tmp == -1)
    {
/*      fprintf(stderr,"erreur lors du changement de droit\n");*/
    }
    else
    {
/*      fprintf(stderr,"changement de droit ok : %s\n",dirname);*/
    }
/*    printf("je suis le fils\n");*/
/*    info_process();*/
/*    fclose(errorstream);*/
  }
  return 1;
}
